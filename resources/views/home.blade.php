@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <section class="page-section-ptb profile-slider">
                            <div class="container">
                                <div class="row justify-content-center mb-5 sm-mb-3">
                                    <div class="col-md-8 text-center">
                                        <h2 class="title divider">Active Profiles</h2>
                                    </div>
                                </div>
                                @if(count($users) > 0)
                                    @foreach($users as $user)
                                        <div class="row">
                                            <div class="col-md-6 sm-mb-3">
                                                <div class="profile-item-hover">
                                                    <a href="profile-details.html" class="profile-item">
                                                        <div class="profile-image clearfix">
                                                            <img class="img-fluid" src={{asset('uploads/profilePic/'. $user->image)}} alt="">
                                                        </div>
                                                        <div class="profile-details profile-text">
                                                            <h5 class="title">{{$user->name}}</h5>
                                                            <span class="text-black">{{ $user->gender}}</span>
                                                            <span class="text-black">({{number_format((float)$user->distance, 2, '.', '')}}M)</span>
                                                            <p class="card-text" >{{\Carbon\Carbon::parse($user->birth_date)->age}}</p>
                                                            <a href="{{ route('set.like', $user->id)}}" class="btn btn-primary">Like</a>
                                                            <a href="{{ route('set.dislike', $user->id)}}" class="btn btn-danger">Disike</a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if(count($users) > 0)
                                        <div class="pagination">
                                            <?php echo $users->links(); ?>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </section>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .profile-item-hover {
        margin-bottom: 20px;
        padding-left: 70px;
    }
</style>

<script>

    function calculate_age(dob) {
        var diff_ms = Date.now() - dob.getTime();
        var age_dt = new Date(diff_ms);

        return Math.abs(age_dt.getUTCFullYear() - 1970);
    }

</script>
