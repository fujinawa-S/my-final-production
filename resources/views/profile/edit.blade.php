<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            プロフィール設定
        </h2>
    </x-slot>

    <div class="profile-page max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6">
        <style>
            .profile-card {
                background-color: #1f2430;
                border: 1px solid #363c4f;
                border-radius: 0.75rem;
                padding: 1.75rem;
                color: #f4f4f8;
            }

            .profile-card header h2,
            .profile-card header p,
            .profile-card label,
            .profile-card span,
            .profile-card p {
                color: inherit;
            }

            .profile-card label {
                display: inline-block;
                margin-bottom: 0.25rem;
                font-weight: 500;
            }

            .profile-card input,
            .profile-card textarea,
            .profile-card select {
                background-color: #2f3640;
                color: #ffffff;
                border: 1px solid #4a4f63 !important;
                border-radius: 0.375rem;
                padding: 0.5rem 0.75rem;
                width: 100%;
                box-sizing: border-box;
            }

            .profile-card input::placeholder,
            .profile-card textarea::placeholder {
                color: rgba(255, 255, 255, 0.7);
            }

            .profile-card button,
            .profile-card .inline-flex {
                font-weight: 600;
            }
        </style>

        <div class="profile-card">
            <div class="max-w-xl space-y-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="profile-card">
            <div class="max-w-xl space-y-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="profile-card">
            <div class="max-w-xl space-y-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>