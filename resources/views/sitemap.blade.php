@php
    use Illuminate\Support\Carbon;
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"> 
    <url>
        <loc>https://thejobz.pk/</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://thejobz.pk/about</loc>
        <lastmod>{{ Carbon::parse('2024-12-31')->format('Y-m-d') }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($citys as $city)
        <url>
            <loc>{{ url('/job-city/' . $city->slug) }}</loc>
             <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    <url>
        <loc>https://thejobz.pk/Navy-Jobs</loc>
         <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>https://thejobz.pk/Bank-Jobs</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    @foreach ($departments as $department)
        <url>
            <loc>{{ url('/job-department/' . $department->slug) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

    @foreach ($jobs as $job)
        <url>
            <loc>{{ url('/job-single/' . $job->slug) }}</loc>
            <lastmod>{{ $job->posted ? Carbon::parse($job->posted)->format('Y-m-d') : '1970-01-01' }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>

            @if ($job->img)
                <image:image>
                    <image:loc>{{ url('/storage/app/public/jobs/' . $job->img) }}</image:loc>
                    <image:title>{{ htmlspecialchars($job->title, ENT_QUOTES) }}</image:title>
                </image:image>
            @endif
        </url>
    @endforeach 
    
    <url>
        <loc>https://thejobz.pk/gold-rates</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    
    <url>
        <loc>{{ url('/blogs') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url> 
    
    @foreach ($blogs as $blog)
        <url>
            <loc>{{ url('/blog/' . $blog->slug) }}</loc>
            <lastmod>{{ Carbon::parse($blog->updated_at)->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach 
    
    @foreach ($armys as $army)
        <url>
            <loc>{{ url('/job-army/' . $army->slug) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
    
    @foreach ($teachings as $teaching)
        <url>
            <loc>{{ url('/job-teaching/' . $teaching->slug) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach 
    
    @foreach ($newspapers as $paper)
        <url>
            <loc>{{ url('/job-newspaper/' . $paper) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    <url>
        <loc>https://thejobz.pk/contact</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
</urlset>
