<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project for Rocket Studio </title>

    <!-- Font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.2-web\css\all.min.css') }}">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Datepicker -->
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/themes/6.6.0/default/default-ocean-blue.css" />
    <script src="https://kendo.cdn.telerik.com/2023.2.718/js/kendo.all.min.js"></script>

    <!-- Stylesheet -->
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 30%;
            /* Full width */
            height: 100%;
            /* Full height */

            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1 class="text-4xl font-semibold">Създаване на CV</h1><br>

    <!-- Form -->
    <form method="post" class="" action="{{ route('candidate.profile.store') }}">
        @csrf

        <!-- First Name field -->
        <input type="text" id="firstName" name="firstName" placeholder="Име..."
            class="border border-gray-800 p-1 w-1/4"><br>
        @error('firstName')
            <span class="text-red-500 font-semibold">{{ $message }}</span>
        @enderror
        <br><br>

        <!-- Second Name field -->
        <input type="text" id="secondName" name="secondName" placeholder="Презиме..."
            class="border border-black p-1 w-1/4"><br>
        @error('secondName')
            <span class="text-red-500 font-semibold">{{ $message }}</span>
        @enderror
        <br>


        <!-- Last Name field -->
        <input type="text" id="lastName" name="lastName" placeholder="Фамилия..."
            class="border border-black p-1 w-1/4"><br>
        @error('lastName')
            <span class="text-red-500 font-semibold">{{ $message }}</span>
        @enderror
        <br><br>

        <!-- Datepicker for birthday date -->
        @php
            $date = new DateTime();
            $result = $date->format('Y-m-d');
        @endphp

        <div>
            <label for="birthday_date" class="text-xl mr-12 font-semibold">Дата на раждане</label>
            <input type="date" id="datePicker" name="birthday_date" value={{ $result }} min="1930-01-01"
                max={{ $result }} class="border border-black p-1 w-36" /><br><br>

        </div>


        <!-- Choose University -->

        <div>
            <select name="university" id="university" class="border border-black p-1 w-1/5">
                <option value="">Изберете университет</option>
                @foreach ($universities as $university)
                    <option value={{ $university['id'] }}>{{ $university['name'] }}</option>
                @endforeach
            </select>

            <br><br>
        </div>




        <!-- Choose skills -->
        <div>
            <select name="skills[]" id='skills' multiple="" class="border border-black p-1 w-48 h-44">
                @foreach ($skills as $skill)
                    <option value="{{ $skill['id'] }}">{{ $skill['name'] }}</option>
                @endforeach
            </select><button class="btn border absolute text-xl bg-gray-200 border-black pb-1 px-2 rounded-md"><i
                    class="fa-solid fa-pencil"></i></button><br>
            @error('skills')
                <span class="text-red-500 font-semibold">{{ $message }}</span>
            @enderror
        </div><br>


        <!-- Submit button -->
        <button type="submit" class="border-2 border-black rounded-2xl px-3 pb-1 font-semibold">Запис на CV</button>
    </form>


    <!-- Trigger/Open The Modal -->
    <button id="myBtn"class="btn border text-xl bg-gray-200 border-black pb-1 ml-1 px-2 rounded-md"><i
            class="fa-solid fa-pencil"></i></button>


    <!-- The Modal -->
    <div id="myModal" class="modal">
  

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close font-bold">&times;</span>
            <form method="post" action="{{ route('university.store') }}">
                @csrf
                <h2 class="font-semibold">Въвеждане на нов университет</h2>
                <!-- Add Unoversity Name field -->
                <input type="text" id="u_name" name="u_name" placeholder="Име на университет..."
                    class="border border-gray-800 p-1 w-4/5"><br>
                @error('u_name')
                    <span class="text-red-500 font-semibold">{{ $message }}</span>
                @enderror
                <br>

                <!-- Accreditation field -->
                <input type="text" id="accreditation" name="accreditation" placeholder="Акредатиционна оценка..."
                    class="border border-black p-1 w-4/5"><br>
                <br>
                {{-- <input type="hidden" name="accreditation_assessment" value="{{ $accreditation ?? @isset($$accreditation)@endisset : null}}"> --}}
                <button type="submit" class="border-2 border-black rounded-2xl px-3 pb-1 font-semibold">Запис</button>
            </form>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



    <!-- Datepicker JS-->
    <script>
        $(document).ready(function() {
            $("#datePicker").kendoDatePicker();
            $(".k-icon").removeClass("k-i-calendar");
            $(".k-icon").addClass('k-i-calendar-date');
        });
    </script>
</body>

</html>
