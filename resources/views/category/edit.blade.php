@extends('app')
@section('content')
    <div class="container h--100vh">
        <div class="row justify-content-center align-items-center h-100 w-100">
            <div class="card w-75">
                <div class="card-header bg-primary text-white font-weight-bold text-uppercase">
                    {{ __('lang.' . (@$item->id != '' ? 'Update' : 'Create') . '_category') }}
                </div>
                <div class="card-body">

                    @if (session('notification'))
                        <div class="alert alert-{{ session('notification')['status'] }} text-center" role="alert">

                            <strong>{{ session('notification')['message'] }}</strong>

                        </div>
                    @endif
                    <form method="POST" action="{{ route('category-update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ @$item->id }}">
                        <div class="form-group row">
                            <label for="title"
                                class="col-md-4 col-form-label text-md-right">{{ __('lang.Category_title') }}
                            </label>
                            <div class="col-md-6">
                                <input id="title" type="text"
                                    class="form-control shadow-none @error('title') is-invalid @enderror" name="title"
                                    required autocomplete="new-title" value="{{ @$item->title }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('lang.Level') }}
                            </label>
                            <div class="col-md-6">

                                <select class="form-control" name="level" id="level">
                                    <option value="1" {{ @$item->level == 1 ? 'selected' : '' }}>Cấp 1</option>
                                    <option value="2" {{ @$item->level == 2 ? 'selected' : '' }}>Cấp 2</option>
                                    <option value="3" {{ @$item->level == 3 ? 'selected' : '' }}>Cấp 3</option>
                                    <option value="4" {{ @$item->level == 4 ? 'selected' : '' }}>Cấp 4</option>
                                </select>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('lang.Status') }}
                            </label>
                            <div class="col-md-6">

                                <select class="form-control" name="status" id="status">
                                    <option value="1" {{ @$item->status == 1 ? 'selected' : '' }}>Bật</option>
                                    <option value="0" {{ @$item->status == 0 ? 'selected' : '' }}>Tắt</option>

                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('lang.' . (@$item->id != '' ? 'Update' : 'Create') . '') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
