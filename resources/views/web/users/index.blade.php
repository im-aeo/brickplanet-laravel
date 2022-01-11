<!--
MIT License

Copyright (c) 2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

@extends('layouts.default', [
    'title' => 'Users'
])

@section('css')
    <style>
        img.user-headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
            margin: 0 auto;
            display: block;
        }

        @media only screen and (min-width: 768px) {
            img.user-headshot {
                width: 60%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-3"><h3>Users</h3></div>
                <div class="col-9 text-right mt-1"><strong>{{ number_format($total) }} Total Users</strong></div>
            </div>
            <form action="{{ route('users.index') }}" method="GET">
                <input class="form-control mb-3" type="text" name="search" placeholder="Search..." value="{{ request()->search }}">
            </form>
            @if (!empty($search))
                <div class="row">
                    @forelse ($users as $user)
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <a href="{{ route('users.profile', $user->username) }}" style="color:inherit;font-weight:600;">
                                        <img class="user-headshot" src="{{ $user->headshot() }}">
                                        <div class="text-truncate mt-1">{{ $user->username }}</div>
                                    </a>
                                    <div class="text-{{ ($user->online()) ? 'success' : 'muted' }}">{{ ($user->online()) ? 'Online' : 'Offline' }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col">No users have been found.</div>
                    @endforelse
                </div>
                {{ $users->onEachSide(1) }}
            @endif
        </div>
    </div>
@endsection
