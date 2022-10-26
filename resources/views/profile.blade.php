@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">
@section('content')
    <section class="sec-index">


        @foreach ($profiles as $profile)
        @if ($profile->id == auth()->user()->id)
        <div class="profile-card-4 text-center">

            <img src="{{ asset($profile->image?->path) }}" class="img img-responsive">
            <div class="profile-content">
                <div class="profile-name">
                    {{ $profile->name }}

                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="profile-overview">
                            <p>Email</p>
                            <h5>  {{ $profile->email }}</h5></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="profile-overview">
                            <p>Phone</p>
                            <h5>  {{ $profile->phone }}</h5></div>
                    </div>
                    <div class="col-xs-4">
                        <div class="profile-overview">
                            <p>Address</p>
                            <h5>  {{ $profile->address }}</h5></div>
                    </div>
                    <div class="col-xs-4">
                        <div class="profile-overview">
                            <a href="{{ route('profiles.edit', $profile->id) }}"
                                class="btn btn-success" style="width:100px ; text-align:center;">
                                Edit
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
        @endforeach





        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="/js/app.js"></script>
        <script type="text/javascript">
            var ctext = 'Confirm you want to Delete ? \n'
            var permissiontext = document.getElementsByName('permissionname');

            console.log(ctext);
            console.log(permissiontext);

            function ConfirmDelete() {

                return confirm(ctext);
            };
        </script>
    </section>
@endsection
