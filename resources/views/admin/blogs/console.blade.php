<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Links Console</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h2 class="my-4">Job Links Console</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Job Title</th>
                    <th>Job Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobs as $job): ?>
                <tr>
                    <td><?= $job->id ?></td>
                    <td><?= htmlspecialchars($job->title) ?></td>
                    <td>
                        <input type="text" class="form-control job-link"
                            value=" {{ route('job-single', ['slug' => $job->slug]) }} " readonly>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-copy" onclick="copyToClipboard(this)">Copy</button>
                        <a href="{{ route('job-single', ['slug' => $job->slug]) }}" target="_blank"
                            class="btn btn-success">View</a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        @if (isset($departmentCounts) && count($departmentCounts))
            <h4 class="mt-5">Jobs by Department</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Total Jobs</th>
                        <th>ID</th>
                        <th>Job Title</th>
                        <th>Department Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departmentCounts as $dep)
                        <tr>
                            <td>{{ $dep->department_name }}</td>
                            <td>{{ $dep->total }}</td>
                            <td><?= $dep->id ?></td>
                            <td><?= htmlspecialchars($dep->title) ?></td>
                            <td>
                                <input type="text" class="form-control job-link"
                                    value=" {{ route('job-department', ['slug' => $dep->dept_slug]) }} " readonly>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-copy" onclick="copyToClipboard(this)">Copy</button>
                                <a href="{{ route('job-department', ['slug' => $dep->dept_slug]) }}" target="_blank"
                                    class="btn btn-success">View</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

    <script>
        function copyToClipboard(btn) {
            let input = btn.closest('tr').querySelector('.job-link');
            input.select();
            document.execCommand('copy');
            btn.style.backgroundColor = 'red';
            btn.style.borderColor = 'red';
            btn.style.color = 'white';

            // alert('Link copied: ' + input.value);
        }
    </script>
</body>

</html>
