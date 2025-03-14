<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover Letter Generator!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://unpkg.com/htmx.org@1.9.6"></script> <!-- Include HTMX -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5 pb-4">
        <h1 class="text-center h1 mb-5">Cover Letter Generator!</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Starts -->
        <form
            hx-post="{{ route('coverletters.submit') }}"
            hx-target="#coverletter"
            hx-swap="innerHTML"
            class="p-4 border rounded shadow mb-5"
        >
            @csrf <!-- Laravel CSRF Protection -->

            <!-- Seek URL -->
            <div class="mb-3">
                <label for="website" class="form-label">Seek URL:</label>
                <input type="url" id="website" name="website" class="form-control" placeholder="Enter Seek URL" required
                    value="{{ old('website') }}">
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required
                    value="{{ old('name') }}">
            </div>

            <!-- Summary -->
            <div class="mb-3">
                <label for="summary" class="form-label">Summary:</label>
                <textarea name="summary" rows="5" class="form-control"
                    placeholder="Write a summary of who you are and your greatest strengths">{{ old('summary')
                    }}</textarea>
            </div>

            <!-- Skills -->
            <div class="mb-3">
                <label for="skills" class="form-label">Skills:</label>
                <textarea name="skills" rows="5" class="form-control" placeholder="List your skills">{{ old('skills')
                    }}</textarea>
            </div>

            <!-- Experience -->
            <div class="mb-3">
                <label for="experience" class="form-label">Experience:</label>
                <textarea name="experience" rows="5" class="form-control" placeholder="List your experience">{{
                    old('experience') }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>

        <!-- Modal -->
        <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content d-flex align-items-center justify-content-center text-center p-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Generating Cover Letter...</p>
                </div>
            </div>
        </div>

        <div id="coverletter" class="mt-5 p-4 border rounded shadow hidden"></div>
    </div>
        <a href="https://buymeacoffee.com/nettis">
            <footer class="bg-gray-800 text-white text-center py-4">
                Buy me a coffee! ❤️
            </footer>
        </a>

</body>
</html>
