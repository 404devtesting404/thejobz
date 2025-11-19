<?php
// ==========================
// Step 1: Define Page Categories & Links
// ==========================
$all_links = [
    'city' => [
        "/job-city/karachi" => "Jobs in Karachi",
        "/job-city/lahore" => "Jobs in Lahore",
        "/job-city/islamabad" => "Jobs in Islamabad",
        "/job-city/rawalpindi" => "Jobs in Rawalpindi",
        "/job-city/multan" => "Jobs in Multan",
        "/job-city/peshawar" => "Jobs in Peshawar",
        "/job-city/quetta" => "Jobs in Quetta",
        "/job-city/faisalabad" => "Jobs in Faisalabad"
    ],
    'department' => [
        "/job-department/medical" => "Medical Jobs",
        "/job-department/education" => "Education Jobs",
        "/job-department/house" => "Household Jobs",
        "/job-department/marketing-company" => "Marketing Jobs",
        "/job-department/manufacturing" => "Manufacturing Jobs",
        "/job-department/security-company" => "Security Jobs",
        "/job-department/private-company" => "Private Company Jobs",
        "/job-department/private-school" => "Private School Jobs",
        "/job-department/hospital-clinic" => "Hospital & Clinic Jobs",
        "/job-department/management" => "Management Jobs"
    ],
    'newspaper' => [
        "/job-newspaper/jang" => "Jang Jobs",
        "/job-newspaper/dawn" => "Dawn Jobs",
        "/job-newspaper/thenews" => "The News Jobs",
        "/job-newspaper/nawaiwaqt" => "Nawaiwaqt Jobs",
        "/job-newspaper/aaj" => "Aaj Jobs",
        "/job-newspaper/dunya" => "Dunya Jobs",
        "/job-newspaper/mashriq" => "Mashriq Jobs",
        "/job-newspaper/khabrain" => "Khabrain Jobs",
        "/job-newspaper/express" => "Express Jobs",
        "/job-newspaper/kawish" => "Kawish Jobs",
        "/job-newspaper/nation" => "Nation Jobs"
    ]
];

// ==========================
// Step 2: Detect Current Page Category
// ==========================
$current_uri = $_SERVER['REQUEST_URI'];
$category = '';

if (strpos($current_uri, '/job-city/') !== false) {
    $category = 'city';
} elseif (strpos($current_uri, '/job-department/') !== false) {
    $category = 'department';
} elseif (strpos($current_uri, '/job-newspaper/') !== false) {
    $category = 'newspaper';
}

// ==========================
// Step 3: Pick Links Based on Category
// ==========================
$links_to_display = $category ? $all_links[$category] : array_merge(...array_values($all_links));

// Shuffle (correct way)
$keys = array_keys($links_to_display);
shuffle($keys);

// Take 5 keys only
$display_links = array_slice($keys, 0, 5);

?>

<div class="explore-cards-wrapper py-5">
    <div class="container text-center">
        <h3 class="explore-heading mb-4">
            Explore More <?php echo ucfirst($category ?: 'Jobs'); ?>
        </h3>

        <div class="row justify-content-center">
            <?php foreach ($display_links as $key): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="{{ url($key) }}" class="explore-card d-block">
                        <div class="explore-card-inner">
                            <div class="explore-card-icon mb-3">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <h5 class="explore-card-title">{{ $links_to_display[$key] }}</h5>
                            <p class="explore-card-sub">Find the latest openings here</p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
