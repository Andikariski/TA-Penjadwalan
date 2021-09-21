 const domain = document.location.origin;

// function api() {
//     $.get(domain + "/api/jadwal/calendar").done((getdata))
//     console.log($.get(domain + "/api/jadwal/calendar").done((getdata)));
// }

// Function untuk get data libur dari proses matching pada controller
async function cekHariLibur(date) {
        const response  = await fetch(`/api/holidays?date=${date}`);
        const data      = await response.json();
        
    return data;
}

// Function untuk mengambil document pada view calendar
async function cekJamKosong(url){
    const response = await fetch(url);
    const data = await response.text();

    const parentEl = document.createElement('div');
    parentEl.innerHTML = data;

    console.log(parentEl);

    const lenghtEl = parentEl.children.length;
    return(lenghtEl > 1);
}

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('ncalendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        height: '100%',
        expandRows: true,
        slotMinTime: '07:00',
        slotMaxTime: '21:30',
        hiddenDays: [0],
        showNonCurrentDates :true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth',
        initialDate: $("#tanggal").val(),
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        selectable: true,
        select: async function (arg) {
            
            // Proses cek hari libur
            const hariLibur = await cekHariLibur(arg.startStr);
            if(hariLibur.is_holiday){
                Swal.fire({
                    icon    : 'warning',
                    title   : 'Tidak Dapat Menjadwalkan',
                    text    : 'Libur ' + hariLibur.name,
                    showConfirmButton: true,
                    // timer: 3500
                });
                return false;
            }

            $("#hari").val(arg.start);
            var idTopik = $("#idTopik").val();
            var hari = $("#hari").val();
            var url = "/jadwal-kosong-semprop?id=" + idTopik + "&date=" + arg.startStr +  "&hari=" + hari.substr(0, 3);
     
            //  Proses cek jam kosong untuk ujian
            const jamTersedia = await cekJamKosong(url);
            if(!jamTersedia){
                Swal.fire({
                    icon    : 'error',
                    title   : 'Tidak Dapat Menjadwalkan',
                    text    : 'Jadwal penuh pada tanggal yang dipilih',
                    showConfirmButton: true,
                    // timer: 3200
                });
                return false;
            }
            $("select[name='waktu_mulai']").load(url);
            $("#add").modal();
            $("#dijadwalkan").val(arg.startStr);
        },
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events

        //Block hari yang sudah lewat
        selectAllow: function(info) { 
            
            return (moment().diff(info.start) <= 800000);
        },
        events: {
            url: domain + "/api/calendarSemprop",
        },
        eventColor:'#378006',
        loading: function (bool) {
            document.getElementById('loading').style.display =
                bool ? 'block' : 'none';
        }
    });
    calendar.render();
});
