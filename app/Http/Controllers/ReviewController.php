<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Models\Work;
use Cloudinary\Api\Upload\UploadApi;
use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use ReflectionClass;

class ReviewController extends Controller
{
    /**
     * レビュー一覧
     */
    public function index()
    {
        $reviews = Review::with(['user', 'work'])
            ->withCount(['favoredBy', 'photos'])
            ->latest()
            ->get();

        $favoriteReviewIds = [];
        if (auth()->check()) {
            $favoriteReviewIds = auth()->user()
                ->favoriteReviews()
                ->pluck('review_favorites.review_id')
                ->all();
        }

        return view('reviews.index', compact('reviews', 'favoriteReviewIds'));
    }

    /**
     * 投稿フォーム
     */
    public function create()
    {
        $works = Work::all();

        return view('reviews.create', compact('works'));
    }

    /**
     * 新規投稿
     */
    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();

        $review = Review::create([
            'user_id' => auth()->id(),
            'work_id' => $validated['work_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'score' => $validated['score'],
            'is_spoiler' => $validated['is_spoiler'] ?? false,
            'is_published' => true,
        ]);

        if ($request->hasFile('photos')) {
            $this->storePhotos($review, $request->file('photos'));
        }

        return redirect()->route('reviews.show', $review)
            ->with('status', 'レビューを投稿しました。');
    }

    /**
     * 詳細表示
     */
    public function show($id)
    {
        $review = Review::with(['user', 'work', 'comments.user', 'photos'])
            ->withCount('favoredBy')
            ->findOrFail($id);

        $alreadyFavored = auth()->check()
            ? auth()->user()->favoriteReviews()
                ->where('review_favorites.review_id', $review->id)
                ->exists()
            : false;

        return view('reviews.show', compact('review', 'alreadyFavored'));
    }

    /**
     * 編集フォーム
     */
    public function edit($id)
    {
        $review = Review::with('photos')->findOrFail($id);
        $works = Work::all();

        return view('reviews.edit', compact('review', 'works'));
    }

    /**
     * 削除
     */
    public function delete($id)
    {
        $review = Review::with('photos')->findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')
            ->with('status', 'レビューを削除しました。');
    }

    /**
     * 更新
     */
    public function update(UpdateReviewRequest $request, $id)
    {
        $validated = $request->validated();

        $review = Review::with('photos')->findOrFail($id);
        $review->update([
            'work_id' => $validated['work_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'score' => $validated['score'],
            'is_spoiler' => $validated['is_spoiler'] ?? false,
        ]);

        if ($request->hasFile('photos')) {
            $existingCount = $review->photos->count();
            $remainingSlots = max(0, 4 - $existingCount);
            $newPhotos = $request->file('photos');

            if ($remainingSlots <= 0) {
                return back()
                    ->withErrors(['photos' => '写真は最大4枚までです。'])
                    ->withInput();
            }

            if (count($newPhotos) > $remainingSlots) {
                return back()
                    ->withErrors(['photos' => "写真はあと{$remainingSlots}枚まで追加できます。"])
                    ->withInput();
            }

            $this->storePhotos($review, $newPhotos);
        }

        return redirect()->route('reviews.show', $review)
            ->with('status', 'レビューを更新しました。');
    }

    /**
     * Cloudinary へアップロードして紐づけ
     */
    private function storePhotos(Review $review, array $photos): void
    {
        $uploadApi = $this->makeUploadApi();

        foreach ($photos as $photo) {
            if (! $photo instanceof UploadedFile) {
                continue;
            }

            $uploadedFile = $uploadApi->upload($photo->getRealPath(), [
                'folder' => 'reviews',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                    'width' => 1200,
                    'height' => 1200,
                    'crop' => 'fill',
                    'gravity' => 'auto',
                ],
            ]);

            $securePath = null;

            if (is_array($uploadedFile) || $uploadedFile instanceof \ArrayAccess) {
                $securePath = $uploadedFile['secure_url'] ?? $uploadedFile['url'] ?? null;
            }

            if (! $securePath && method_exists($uploadedFile, 'getSecurePath')) {
                $securePath = $uploadedFile->getSecurePath();
            }

            if ($securePath) {
                $review->photos()->create([
                    'path' => $securePath,
                ]);
            }
        }
    }

    private function makeUploadApi(): UploadApi
    {
        $uploadApi = cloudinary()->uploadApi();

        if (! config('cloudinary.verify_ssl', true)) {
            $reflection = new ReflectionClass($uploadApi);
            $property = $reflection->getProperty('apiClient');
            $property->setAccessible(true);

            $apiClient = $property->getValue($uploadApi);
            $httpClient = $apiClient->httpClient ?? null;

            if ($httpClient instanceof Client) {
                $apiClient->httpClient = new Client(array_merge(
                    $httpClient->getConfig(),
                    ['verify' => false]
                ));
            }
        }

        return $uploadApi;
    }
}
