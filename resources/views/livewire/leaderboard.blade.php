<div>
    <div class="container leaderboard-container">
        <div class="row justify-content-between">
            <h2 class="font-weight-bold col-6">{{ __('Users leaderboard by rating') }}</h2>

            <div class="input-group rounded col-4">
                <input type="text" wire:model="term"
                       class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            </div>
        </div>

        @if (count($users) < 1)
            <div class="alert alert-primary mx-5 my-5 text-center" role="alert">{{ __("No users were found") }}</div>
        @else
            <table class="table leaderboard-table">
                <thead>
                <tr>
                    <th class="h5">{{ __('Place') }}</th>
                    <th class="h5">{{ __('User') }}</th>
                    <th class="h5">{{ __('Rating') }}</th>
                    <th class="h5">{{ __('Registered') }}</th>
                    <th class="h5">{{ __('User profile') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <h3 class="ml-3"><b>{{ $place++ }}</b></h3>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($user->avatar) }}" alt="{{ __('User Avatar') }}" class="leaderboard-user circle-img--small mr-2">
                                <div class="user-info__basic">
                                    <h5 class="mb-0">{{ $user->name }}</h5>
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-baseline">
                                <h4 class="mr-1">{{ $user->rating }}</h4>
                            </div>
                        </td>
                        <td>{{ $user->registered }}</td>
                        <td>
                            <a href="{{ route('user.profile.show', $user->id) }}">
                                <button class="btn btn-success btn-md">{{ __('Profile') }}</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
