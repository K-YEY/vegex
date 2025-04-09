<x-ui-dash.layout>
    <div class="card mt-4">
        <div class="card-header">
            <h5>Basic Info</h5>
        </div>
        <div class="card-body pt-0">
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-6">
                        <div class="input-group input-group-static">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                value="{{ old('first_name', explode(' ', trim($user->name))[0]) ?? '' }}" required
                                onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-static">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ old('last_name', explode(' ', trim($user->name))[1]) ?? '' }}" required
                                onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Confirm Email</label>
                                <input type="email" name="confirm_email" class="form-control"
                                    value="{{ old('confirm_email', $user->email) }}" required onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="input-group input-group-static">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $user->phone) }}" required onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update Profile</button>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <h5>Change Password</h5>
        </div>
        <div class="card-body pt-0">
            <form method="post" action="{{ route('profile.password.update') }}">
                @csrf
                @method('put')
                <div class="input-group input-group-outline">
                    <label class="form-label">Current password</label>
                    <input type="password" name="current_password" class="form-control" required onfocus="focused(this)"
                        onfocusout="defocused(this)">
                </div>
                <div class="input-group input-group-outline my-4">
                    <label class="form-label">New password</label>
                    <input type="password" name="password" class="form-control" required onfocus="focused(this)"
                        onfocusout="defocused(this)">
                </div>
                <div class="input-group input-group-outline">
                    <label class="form-label">Confirm New password</label>
                    <input type="password" name="password_confirmation" class="form-control" required
                        onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                <h5 class="mt-5">Password requirements</h5>
                <p class="text-muted mb-2">
                    Please follow this guide for a strong password:
                </p>
                <ul class="text-muted ps-4 mb-0 float-start">
                    <li>
                        <span class="text-sm">One special characters</span>
                    </li>
                    <li>
                        <span class="text-sm">Min 8 characters</span>
                    </li>
                    <li>
                        <span class="text-sm">One number (2 are recommended)</span>
                    </li>
                    <li>
                        <span class="text-sm">Change it often</span>
                    </li>
                </ul>
                <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
            </form>
        </div>
    </div>
</x-ui-dash.layout>
