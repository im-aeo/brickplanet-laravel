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
    'title' => 'Promocodes'
])

@section('meta')
    <meta name="routes" data-redeem="{{ route('account.promocodes.redeem') }}">
@endsection

@section('css')
    <style>
        .code-image {
            background: var(--section_bg_inside);
            background-image: url('{{ asset('img/promocodes.png') }}');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            border: 1px solid var(--section_border_color);
            border-bottom: none;
            height: 180px;
            width: 283px;
        }

        .code-info {
            background: var(--section_bg);
            border: 1px solid var(--section_border_color);
            height: auto;
            min-height: 50px;
            width: 283px;
            padding: 15px;
            text-align: center;
            box-shadow: var(--section_box_shadow);
        }

        .code-info hr {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .code-title {
            font-size: 17px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .code-text {
            font-size: 14px;
            font-weight: 400;
        }

        @media only screen and (min-width: 768px) {
            .col-md-9 {
                padding-left: 75px;
            }
        }

        @media only screen and (max-width: 768px) {
            .code-image {
                margin: 0 auto;
            }

            .code-info {
                margin: 0 auto;
                margin-bottom: 16px;
            }
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/promocodes.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="code-image"></div>
            <div class="code-info">
                <div class="code-title">How does it work?</div>
                <hr>
                <div class="code-text">Enter special codes in the text box and press the button for unique and special items!</div>
            </div>
        </div>
        <div class="col-md-9">
            <h3>Promocodes</h3>
            <form id="codeForm">
                <label for="code">Enter Code</label>
                <div class="input-group mb-2">
                    <input class="form-control" type="text" name="code" placeholder="Code" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Redeem</button>
                    </div>
                </div>
            </form>
            <div id="message"></div>
            <h4 class="mt-4">Current Code Items</h4>
            <div class="card">
                <div class="card-body" @if (count($items) > 0) style="padding-bottom:0;" @endif>
                    <div class="row">
                        @forelse ($items as $item)
                            <div class="col-4 col-md-3">
                                <div class="card has-bg" style="border:none;padding:{{ itemTypePadding($item->type) }};">
                                    <a href="{{ route('catalog.item', [$item->id, $item->slug()]) }}" target="_blank">
                                        <img src="{{ $item->thumbnail() }}">
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col">There are currently no code items.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
