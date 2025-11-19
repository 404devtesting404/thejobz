
<div class="row">
    @if($army_jobs_count > 0)
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
        <div class="job-grid style2">
            <div class="job-title-sec">
                <div class="c-logo recent_job">
                    {{-- <img hidden src="{{ asset('resources/assets/images/resource/pak_army_jobs.jfif') }}"
                        alt="" /> --}}
                </div>
            </div>
            <span>
                <h3><a href="#" title="">Pak Army Jobs</a></h3>
            </span>
            <p class="job-lctn">{{ $army_jobs_count }} Jobs Available</p>
            <div class="grid-info-box">
                <a href="{{ route('Army-Jobs') }}" title="">See More</a>
            </div>
        </div>
    </div>
    @endif
    @if($navy_jobs_count > 0)
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
        <div class="job-grid style2">
            <div class="job-title-sec">
                <div class="c-logo recent_job" >
                    {{-- <img hidden src="{{ asset('resources/assets/images/resource/pak_army_jobs.jfif') }}"
                        alt="" /> --}}
                </div>
            </div>
            <span>
                <h3><a href="#" title="">Pak Navy Jobs</a></h3>
            </span>
            <p class="job-lctn">{{ $navy_jobs_count }} Jobs Available</p>
            <div class="grid-info-box">
                <a href="{{ route('Navy-Jobs') }}" title="">See More</a>
            </div>
        </div>
    </div>
    @endif
    @if($police_jobs_count > 0)
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
        <div class="job-grid style2">
            <div class="job-title-sec">
                <div class="c-logo recent_job">
                    {{-- <img  hidden src="{{ asset('resources/assets/images/resource/pak_army_jobs.jfif') }}"
                        alt="" /> --}}
                </div>
            </div>
            <span>
                <h3><a href="#" title="">Police Jobs</a></h3>
            </span>
            <p class="job-lctn">{{ $police_jobs_count }} Jobs Available</p>
            <div class="grid-info-box">
                <a href="{{ route('Police-Jobs') }}" title="">See More</a>
            </div>
        </div>
    </div>
    @endif
    @if($bank_jobs_count > 0)
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
        <div class="job-grid style2">
            <div class="job-title-sec">
                <div class="c-logo recent_job">
                    {{-- <img hidden src="{{ asset('resources/assets/images/resource/pak_army_jobs.jfif') }}"
                        alt="" /> --}}
                </div>
            </div>
            <span>
                <h3><a href="#" title="">Bank Jobs</a></h3>
            </span>
            <p class="job-lctn">{{$bank_jobs_count}} Jobs Available</p>
            <div class="grid-info-box">
                <a href="{{ route('Bank-Jobs') }}" title="">See More</a>
            </div>
        </div>
    </div>
    @endif
</div>

