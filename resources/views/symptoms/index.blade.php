<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('boostrap/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="{{ asset('boostrap/bootstrap.js') }}"></script>
</head>
<body>
    <div class="container mt-3">
        <br>
        <h2>Symptoms</h2>
        <br>
        <form id="symptom-form">
            <div class="row">
                <div class="col-10">
                    <input type="text" class="form-control" name="symptoms" id="symptoms" placeholder="Add Symptoms..." aria-label="">
                    <p style="font-size: smaller;"><b>Note: symptoms should be separated by commas (e.g., "Fever,Headache,Cough,Fatigue").</b></p>
                </div>
                <div class="col-1">
                    <button type="submit" id="add" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form><br>
        @php
        $alphabets = range('A', 'Z');
        @endphp
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            @foreach ($alphabets as $alphabet)
            <li class="nav-item">
                <a class="nav-link alpha-list list-{{$alphabet}}" href="#{{$alphabet}}">{{ $alphabet }} </a>
            </li>
            @endforeach
        </ul>
        <div class="container">
            @foreach ($groupedSymptoms as $character => $symptoms)
            <div id="{{$character}}" class="col-12"><br>
                <h3>{{ $character }}</h3>
                <div class="row">
                    @foreach ($symptoms as $symptom)
                    <div class="col-3">
                        <p>{{ $symptom->name }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#symptom-form").on("submit", function(e) {
                    e.preventDefault();
                    var symptoms = $("#symptoms").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/symptoms/save',
                        data: {
                            symptoms: symptoms
                        },
                        success: function(data) {
                            $.each(data, function(index, value) {
                                let alpha = value.charAt(0).toUpperCase();;
                                var newDiv = $('<div class="col-3"><p>' + value + '</p></div>');
                                // Append the new div to the existing structure
                                $('#' + alpha + ' .row').append(newDiv);
                            });
                        }
                    });
                });

            });
            $(".nav-link").click(function() {
                $(".nav-link ").removeClass("active");
                // $(".tab").addClass("active"); // instead of this do the below 
                $(this).addClass("active");
            });
        </script>
</body>
</html>