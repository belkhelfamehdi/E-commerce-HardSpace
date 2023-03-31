
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Phone Number') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('phone.verify') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="confirmation_number" class="col-md-4 col-form-label text-md-right">{{ __('Confirmation Number') }}</label>

                                <div class="col-md-6">
                                    <input id="confirmation_number" type="text" class="form-control @error('confirmation_number') is-invalid @enderror" name="confirmation_number" value="{{ old('confirmation_number') }}" required autofocus>

                                    @error('confirmation_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Verify') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
