<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <div id="DigitalCLOCK" style="font-size:40px" class="clock" onload="showTime()"></div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div>

            <button id="check_in" class=" border-b-stone-900"
                style="border:1px solid black;padding:20px 30px; backgroundColor:green;cursor:pointer;border-radius:10px">Punch
                In </button>
            <button id="check_out" class=" border-b-stone-900"
                style="border:1px solid black;padding:20px 30px; backgroundColor:green;cursor:pointer;border-radius:10px">Punch
                OUt </button>
            <h1 id="done_for_today">Attendance done for today</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>

        $('#done_for_today').hide
        $('#check_out').hide
           
        // Code By Webdevtrick ( https://webdevtrick.com )
                function check_attendance(){
                onload= $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: "/get_data",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "employee_id": "{{Auth::user()->id}}",
                       
                    },
                    success: function(response) {
                        if(response.success == 1){
                            // hide a button in html
                            $('#check_in').hide();
                            $('#done_for_today').hide();
                            
                        }
                        else
                        {
                            $('#check_out').show();
                            $('#done_for_today').hide();
                            
                        }
                        
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/get_out_data",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "employee_id": "{{Auth::user()->id}}",
                       
                    },
                    success: function(response) {
                        if(response.success == 1){
                            // hide a button in html
                            $('#check_out').hide();
                            $('#done_for_today').show();
                        }
                        else
                        {
                            $('#check_out').show();
                            
                            
                        }
                    }
                });
            });
      
}

        var timeDta ;
        function showTime(){
            var date = new Date();
            var h = date.getHours(); 
            var m = date.getMinutes(); 
            var s = date.getSeconds(); 
            var session = "AM";
            
            if(h == 0){
                h = 12;
            }
            
            if(h > 12){
                h = h - 12;
                session = "PM";
            }
            
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            
            var time = h + ":" + m + ":" + s + " " + session;

            timeDta= time
         
            document.getElementById("DigitalCLOCK").innerText = time;
            document.getElementById("DigitalCLOCK").textContent = time;
            
            setTimeout(showTime, 1000);
          
            
        }
         
      var timee=  showTime();

      check_attendance()
        // ajax laravel post
        $(document).ready(function() {
            $('#check_in').click(function() {
                $.ajax({
                    type: "POST",
                    url: "/check_in",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "in_time": timeDta,
                        "employee_id": "{{Auth::user()->id}}",
                       
                    },
                    success: function(response) {
                        console.log(response);
                        check_attendance()
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#check_out').click(function() {
                $.ajax({
                    type: "POST",
                    url: "/check_out",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "out_time": timeDta,
                        "employee_id": "{{Auth::user()->id}}",
                       
                    },
                    success: function(response) {
                        console.log(response);
                        $('#check_out').hide();
                        // add a button in html
                      

                    }
                });
            });
        });
    </script>
</x-app-layout>