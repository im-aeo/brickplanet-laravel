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
    'title' => 'Spaces'
])

@section('css')
    <style>
        .group {
            position: relative;
            margin-top: 50px;
        }

        img.group-icon {
            background: var(--headshot_bg);
            border-radius: 50%;
            width: 96px;
            height: 96px;
            margin: 0 auto;
            top: -55px;
            left: 0;
            right: 0;
            z-index: 1;
            position: absolute;
            display: block;
        }

        .group-name {
            font-size: 18px;
            margin-top: 31px;
        }

        .group-name a {
            color: inherit;
            text-decoration: none;
        }

        .group-member-count {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .group-description {
            font-size: 13px;
            height: 55px;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-1">
        <div class="col">
            <h3>Spaces</h3>
        </div>
        <div class="col text-right">
            <a href="{{ route('creator_area.index', ['t' => 'group']) }}" class="btn btn-success"><i class="fas fa-plus"></i> Create</a>
        </div>
    </div>
    <form action="{{ route('groups.index') }}" method="GET">
        <div class="input-group">
            <input class="form-control" type="text" name="search" placeholder="Search for spaces..." value="{{ request()->search }}">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-search"></i>
                    <span class="hide-sm">Search</span>
                </button>
            </div>
        </div>
    </form>
    <div class="row" style="margin-top:30px;">
        @forelse ($groups as $group)
            <div class="col-md-4 text-center">
                <div class="group">
                    <a href="{{ route('groups.view', [$group->id, $group->slug()]) }}">
                        <img class="group-icon" src="{{ $group->thumbnail() }}">
                    </a>
                    <div class="card">
                        <div class="card-body">
                            <div class="group-name text-truncate">
                                <a href="{{ route('groups.view', [$group->id, $group->slug()]) }}">{{ $group->name }}</a>
                            </div>
                            <div class="group-member-count">{{ number_format($group->member_count) }} Members</div>
                            <div class="group-description">{{ $group->description ?? 'This space does not have a description.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">No spaces found.</div>
        @endforelse
    </div>
    {{ $groups->onEachSide(1) }}
@endsection
