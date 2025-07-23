<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mb-0">Student Enrollment Form</h2>
                        <p class="text-center text-muted mt-2 mb-0"><small>Fields marked with <span class="text-danger">*</span> are required</small></p>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <h5>Please correct the following errors:</h5>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('enrollments.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mobile_number" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required>
                                @error('mobile_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="mb-3">
                                <label class="form-label">Mode</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode" id="mode_online" value="Online" {{ old('mode') == 'Online' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="mode_online">Online</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="mode" id="mode_offline" value="Offline" {{ old('mode') == 'Offline' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="mode_offline">Offline</label>
                                </div>
                                @error('mode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="professional" class="form-label">Professional Status</label>
                                <select class="form-select @error('professional') is-invalid @enderror" id="professional" name="professional">
                                    <option value="">Select Professional Status (Optional)</option>
                                    <option value="Student" {{ old('professional') == 'Student' ? 'selected' : '' }}>Student</option>
                                    <option value="JobSeeker" {{ old('professional') == 'JobSeeker' ? 'selected' : '' }}>Job Seeker</option>
                                    <option value="Fresher" {{ old('professional') == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                                    <option value="NonIT-IT" {{ old('professional') == 'NonIT-IT' ? 'selected' : '' }}>Non IT to IT</option>
                                    <option value="WorkingProfessional" {{ old('professional') == 'WorkingProfessional' ? 'selected' : '' }}>Working Professional</option>
                                </select>
                                @error('professional')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3" id="experience_div" style="display: none;">
                                <label for="experience" class="form-label">Experience (in years)</label>
                                <input type="number" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience') }}">
                                @error('experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="mb-3">
                                <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                                <select class="form-select @error('course') is-invalid @enderror" id="course" name="course" required>
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course }}" {{ old('course') == $course ? 'selected' : '' }}>{{ $course }}</option>
                                    @endforeach
                                </select>
                                @error('course')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit Enrollment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('professional').addEventListener('change', function() {
            const experienceDiv = document.getElementById('experience_div');
            if (this.value === 'WorkingProfessional') {
                experienceDiv.style.display = 'block';
            } else {
                experienceDiv.style.display = 'none';
            }
        });
    </script>
</body>
</html>
