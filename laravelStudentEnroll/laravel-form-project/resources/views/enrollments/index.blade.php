<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="mb-0">Student Enrollments</h2>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Add New Enrollment</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <form action="{{ route('enrollments.index') }}" method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="course" class="form-label">Filter by Course</label>
                            <select name="course" id="course" class="form-select">
                                <option value="">All Courses</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course }}" {{ request('course') == $course ? 'selected' : '' }}>
                                        {{ $course }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="enroll_date" class="form-label">Enrolled From Date</label>
                            <input type="date" class="form-control" id="enroll_date" name="enroll_date" 
                                   value="{{ request('enroll_date') }}" 
                                   max="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('enrollments.index', array_merge(
                                        request()->except(['sort', 'direction']),
                                        ['sort' => 'name', 'direction' => $sortField === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc']
                                    )) }}" class="text-decoration-none text-dark">
                                        Name
                                        @if($sortField === 'name')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('enrollments.index', array_merge(
                                        request()->except(['sort', 'direction']),
                                        ['sort' => 'degree', 'direction' => $sortField === 'degree' && $sortDirection === 'asc' ? 'desc' : 'asc']
                                    )) }}" class="text-decoration-none text-dark">
                                        Degree
                                        @if($sortField === 'degree')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('enrollments.index', array_merge(
                                        request()->except(['sort', 'direction']),
                                        ['sort' => 'mode', 'direction' => $sortField === 'mode' && $sortDirection === 'asc' ? 'desc' : 'asc']
                                    )) }}" class="text-decoration-none text-dark">
                                        Mode
                                        @if($sortField === 'mode')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Time Slots</th>
                                <th>Enrolled On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->degree ?? 'N/A' }}</td>
                                    <td>{{ $student->mode ?? 'N/A' }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->course }}</td>
                                    <td>
                                        @if(is_array($student->time_slot))
                                            {{ implode(', ', $student->time_slot) }}
                                        @else
                                            {{ $student->time_slot }}
                                        @endif
                                    </td>
                                    <td>{{ $student->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No enrollments found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
