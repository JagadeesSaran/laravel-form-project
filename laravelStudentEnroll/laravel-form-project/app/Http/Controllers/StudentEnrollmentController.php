<?php

namespace App\Http\Controllers;

use App\Models\StudentEnrollment;
use Illuminate\Http\Request;

class StudentEnrollmentController extends Controller
{
    private $courses = [
        'MERN Fullstack-AI',
        'JAVA FullStack AI',
        'MERN FullStack',
        'JAVA FullStack',
        'DevOps',
        'Linux Automation',
        'Spring Cloud',
        'K8S',
        'Docker',
        'Helm'
    ];



    public function create()
    {
        return view('enrollments.create', [
            'courses' => $this->courses
        ]);
    }

    public function index(Request $request)
    {
        $query = StudentEnrollment::query();

        // Apply filters
        if ($request->filled('course')) {
            $query->where('course', $request->course);
        }
        if ($request->filled('enroll_date')) {
            $query->whereDate('created_at', '>=', $request->enroll_date);
        }

        // Apply sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        if (in_array($sortField, ['name', 'degree', 'mode', 'created_at'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        // Get paginated results
        $students = $query->paginate(10)->withQueryString();

        return view('enrollments.index', [
            'students' => $students,
            'courses' => $this->courses,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
            'filters' => $request->only(['course', 'enroll_date'])
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'mobile_number' => 'required|string|regex:/^[0-9]{10}$/',
            'email' => 'required|email:rfc,dns|max:255|unique:student_enrollments',
            'mode' => 'nullable|in:Online,Offline',
            'professional' => 'nullable|in:Student,JobSeeker,Fresher,NonIT-IT,WorkingProfessional',
            'experience' => 'nullable|integer|min:0|max:50',
            'course' => 'required|string|in:MERN Fullstack-AI,JAVA FullStack AI,MERN FullStack,JAVA FullStack,DevOps,Linux Automation,Spring Cloud,K8S,Docker,Helm'
        ], [
            'name.required' => 'Please enter your name',
            'name.regex' => 'Name should only contain letters and spaces',
            'mobile_number.required' => 'Please enter your mobile number',
            'mobile_number.regex' => 'Mobile number must be 10 digits',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'degree.required' => 'Please select your degree',
            'degree.in' => 'Please select a valid degree option',
            'major.required' => 'Please enter your major/specialization',
            'age.required' => 'Please enter your age',
            'age.min' => 'You must be at least 16 years old to enroll',
            'age.max' => 'Age cannot be more than 100 years',
            'mode.required' => 'Please select your preferred mode',
            'mode.in' => 'Please select a valid mode option',
            'professional.required' => 'Please select your professional status',
            'professional.in' => 'Please select a valid professional status',
            'experience.required_if' => 'Please enter your years of experience',
            'experience.min' => 'Experience cannot be negative',
            'experience.max' => 'Experience cannot be more than 50 years',
            'time_slot.required' => 'Please select at least one time slot',
            'time_slot.min' => 'Please select at least one time slot',
            'time_slot.max' => 'You cannot select more than 4 time slots',
            'time_slot.*.in' => 'Please select valid time slots',
            'course.required' => 'Please select a course',
            'course.in' => 'Please select a valid course option'
        ]);

        StudentEnrollment::create($validated);

        return redirect()->back()->with('success', 'Enrollment submitted successfully!');
    }
}
