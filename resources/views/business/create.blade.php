<html>

<head>
    <title>Welcome to My Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Create Business with Branches</h2>

        <form action="{{ route('business.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Business Name</label>
            <input type="text" name="name" id="name">

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number">

            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo">

            <h2>Add Branches</h2>
            <div class="branches">
                <div class="branch">
                    <label for="branch_name">Branch Name</label>
                    <input type="text" name="branch_name[]" class="branch_name">

                    <!-- Working Week Days and Timings -->
                    <h3>Working Week Days and Timings</h3>
                    {{-- @foreach (['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day)
                        <div class="working_hours">
                            <label for="{{ $day }}_start_time">{{ ucfirst($day) }}:</label>
                            <input type="text" name="working_hours[0][{{ $day }}][start_time]" class="{{ $day }}_start_time" placeholder="Start time">
                            <input type="text" name="working_hours[0][{{ $day }}][end_time]" class="{{ $day }}_end_time" placeholder="End time">

                            <!-- Closed Checkbox for the Day -->
                            <label for="{{ $day }}_closed">Closed:</label>
                            <input type="checkbox" name="working_hours[0][{{ $day }}][closed]" class="{{ $day }}_closed">
                        </div>
                    @endforeach --}}
                    @foreach(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day)
                    <div class="working_hours">
                        <label for="{{ $day }}_start_time">{{ ucfirst($day) }}:</label>
                        <input type="text" name="working_hours[0][{{ $day }}][start_time]" class="{{ $day }}_start_time" placeholder="HH:MM">
                        <input type="text" name="working_hours[0][{{ $day }}][end_time]" class="{{ $day }}_end_time" placeholder="HH:MM">

                        <!-- Closed Checkbox for the Day -->
                        <label for="{{ $day }}_closed">Closed:</label>
                        <input type="checkbox" name="working_hours[0][{{ $day }}][closed]" class="{{ $day }}_closed">
                    </div>
                @endforeach
                    <!-- Branch Images -->
                    <h3>Branch Images</h3>
                    <input type="file" name="branch_images[0][]" class="branch_images" multiple>
                </div>
            </div>

            <button type="button" id="add_branch">Add Another Branch</button>

            <button type="submit">Create Business</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // JavaScript to toggle working hour fields based on the 'closed' checkbox
    document.addEventListener('change', function(event) {
        if (event.target.classList.contains('closed')) {
            const branch = event.target.closest('.branch');
            const workingHours = branch.querySelectorAll('.working_hours input');
            const isChecked = event.target.checked;

            workingHours.forEach(input => {
                input.disabled = isChecked;
            });
        }
    });

    // JavaScript to dynamically add branches
    let branchCounter = 1;
    document.getElementById('add_branch').addEventListener('click', function() {
        branchCounter++;
        const branchesDiv = document.querySelector('.branches');
        const branchTemplate = document.querySelector('.branch');
        const clone = branchTemplate.cloneNode(true);
        clone.querySelectorAll('.branch_name').forEach(input => {
            input.name = `branch_name[]`;
        });
        clone.querySelectorAll('.closed').forEach(input => {
            input.name = `closed[]`;
        });
        clone.querySelectorAll('.branch_images').forEach(input => {
            input.name = `branch_images[${branchCounter}][]`;
        });
        clone.querySelectorAll('.working_hours').forEach(workingHoursDiv => {
            const day = workingHoursDiv.querySelector('label').getAttribute('for');
            workingHoursDiv.querySelector(`.${day}_start_time`).name =
                `working_hours[${branchCounter}][${day}][start_time]`;
            workingHoursDiv.querySelector(`.${day}_end_time`).name =
                `working_hours[${branchCounter}][${day}][end_time]`;
        });
        branchesDiv.appendChild(clone);
    });
</script>

</html>
