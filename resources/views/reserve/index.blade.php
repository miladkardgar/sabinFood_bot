@extends('layout.master')
@section('title','منو غذا')
@section('body')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">برنامه ماهانه</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                {{--                <a href="{{route('foodList.create')}}" class="btn btn-primary">افزودن غذا</a>--}}
            </div>
        </div>
    </div>

    <h2>برنامه غذایی ماه <strong class="text-danger">{{jdate('F',time())}}</strong></h2>
    <main>

        <table id="cal1" class="fc-table">
            <caption>
                <div class="row form-group">
                    <div class="col-4">
                        <label for="fc-year">سال:</label>
                        <select name="fc-year" class="fc-year form-control">
                            <option value="1391">1391</option>
                            <option value="1392">1392</option>
                            <option value="1393">1393</option>
                            <option value="1394">1394</option>
                            <option value="1395">1395</option>
                            <option value="1396">1396</option>
                            <option value="1397">1397</option>
                            <option value="1398">1398</option>
                            <option value="1399">1399</option>
                            <option value="1400">1400</option>
                            <option value="1401">1401</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="fc-month">ماه:</label>
                        <select name="fc-month" class="fc-month form-control">
                            <option value="0">فروردین</option>
                            <option value="1">اردیبهشت</option>
                            <option value="2">خرداد</option>
                            <option value="3">تیر</option>
                            <option value="4">مرداد</option>
                            <option value="5">شهریور</option>
                            <option value="6">مهر</option>
                            <option value="7">آبان</option>
                            <option value="8">آذر</option>
                            <option value="9">دی</option>
                            <option value="10">بهمن</option>
                            <option value="11">اسفند</option>
                        </select>
                    </div>
                </div>
            </caption>
            <tr>
                <th>شنبه</th>
                <th>یکشنبه</th>
                <th>دوشنبه</th>
                <th>سه شنبه</th>
                <th>چهارشنبه</th>
                <th>پنچشنبه</th>
                <th>جمعه</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </main>
    @include('errors')
    <div class="modal" tabindex="-1" role="dialog" id="modalFoodOrder">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">انتخاب نوع غذا</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('foodDay.reserve')}}" method="post">
                        <input type="hidden" name="time" value="" class="time">
                        @csrf
                        <div class="row">
                            <div class="col-12 form-group">
                                <h3 class="text-center">
                                    <span class="day"></span>
                                    <strong class="month text-danger"></strong>
                                    <span class="year"></span>
                                </h3>
                            </div>
                            <div class="col-12 form-group text-center">
                                <label for="title">نوع غذا: </label>
                                <strong class="food"></strong>
                            </div>
                            <div class="col-12 form-group text-center">
                                <label for="title">قیمت: </label>
                                <strong class="price"></strong><small> تومان</small>
                            </div>
                            <div class="col-12 form-group">
                                <button type="submit" class="btn btn-success float-left px-3">رزرو</button>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-info m-1">
                        <div class="user"></div>
                    </div>
                    <div class="alert alert-info m-1">
                        <div class="occasion"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalFoodCustom">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">انتخاب نوع غذا</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <div class="occasion"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('/calendar/css/calendar.css')}}">
@endpush
@push('script')
    <script src="{{asset('/calendar/scripts/jalali.js')}}"></script>
    <script src="{{asset('/calendar/scripts/hijri.js')}}"></script>

    <script>
        function comma(value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
        }
        function modalPopUp(time, day, month, year, occasion, dayOff, user, food, price) {
            var modal;
            if (dayOff == 0) {
                modal = $("#modalFoodOrder")
            } else {
                modal = $("#modalFoodCustom")
            }
            $(modal).find(".time").val(time);
            $(modal).find(".day").html(day);
            $(modal).find(".month").html(month);
            $(modal).find(".year").html(year);
            $(modal).find(".occasion").html(occasion);
            $(modal).find(".user").html(user);
            $(modal).find(".food").html(food);
            $(modal).find(".price").html(comma(price));
            $(modal).modal('show')
        }

        $(document).ready(function () {
            InitCalendar($("#cal1"));
        });

        var _year;
        var _month;
        var _day = 1;
        var _currDay;
        var _jlcal = new JalaliCal();
        var _hjcal = new HijriCal();

        /* sets table and calendar defaults */
        function InitCalendar(table) {
            var today = new Date();
            var year = today.getFullYear();
            var month = today.getMonth() + 1;
            var day = today.getDate();
            var dayofweek;

            var jalaliDate = _jlcal.toJalaali(year, month, day);
            _year = jalaliDate.jy;
            _month = jalaliDate.jm - 1;
            $(".fc-year").val(_year);
            $(".fc-month").val(_month);
            UpdateCal(table, _year, _month, _day);
        }

        /* updates table values */
        function UpdateCal(table, year, month, day) {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            var reserveList = [];
            $.ajax({
                url: "{{route('foodDay.reserveList')}}",
                type: "POST",
                dataType: 'json',
                data: {mYear: year, mMonth: month},
                success: function (data) {
                    reserveList.data = data;
                    var today, dayOfWeek, daysInMonth, count = 1;
                    var tb = $(table), td;
                    var j2g, g2h;
                    var now = new Date();

                    j2g = _jlcal.toGregorian(year, month + 1, 1);
                    today = new Date(j2g.gy, j2g.gm - 1, j2g.gd);
                    dayOfWeek = today.getDay();
                    dayOfWeek = (dayOfWeek == 6) ? 0 : dayOfWeek + 1;
                    daysInMonth = _jlcal.jalaaliMonthLength(year, month);
                    if ((dayOfWeek == 5 && daysInMonth > 30) || (dayOfWeek == 6 && daysInMonth >= 30)) {
                        $(tb).find("tr:last").removeClass("hidden");
                    } else {
                        $(tb).find("tr:last").addClass("hidden");
                    }

                    // $(tb).find("td span").popover("destroy");
                    $(tb).find("td").text("")
                        .removeAttr("data-jl")
                        .removeAttr("data-gr")
                        .removeAttr("data-hj")
                        .removeClass("dayoff");
                    td = $(tb).find("td");

                    for (var index = dayOfWeek; index < daysInMonth + dayOfWeek; index++) {
                        var element = td[index];
                        j2g = _jlcal.toGregorian(year, month + 1, count);
                        g2h = _hjcal.toHijri(j2g.gy, j2g.gm - 1, j2g.gd);
                        today = new Date(j2g.gy, j2g.gm - 1, j2g.gd);
                        var nowDate = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
                        var dayOff = 0;
                        if (gd2Txt(today.getDay()) == "Fir" || isoff("jl", month, count) || isoff("hj", g2h.hm, g2h.hd)) {
                            $(element).addClass("dayoff");
                            dayOff = 1;
                        }
                        if (gd2Txt(today.getDay()) == "Thu") {
                            dayOff = 1;
                        }
                        var res = '';
                        var countUser = 0;
                        var food = '';
                        $.each(reserveList.data, function (index, item) {
                            var dates = nowDate;
                            var dates1 = dates.split("-");
                            var newDate = dates1[1] + "/" + dates1[2] + "/" + dates1[0];
                            var finalTimeRes = new Date(newDate).getTime();
                            var dates = item.date;
                            var dates1 = dates.split("-");
                            var newDate = dates1[1] + "/" + dates1[2] + "/" + dates1[0];
                            var finalTimeDateRes = new Date(newDate).getTime();

                            if (finalTimeRes === finalTimeDateRes) {
                                res = res + '<p><span>' + item.title + '</span> | <strong class="text-danger">' + item.type + '</strong>';
                                food = item.title;
                            }
                        });

                        $(element).attr("data-jl", (year + "-" + (month + 1) + "-" + count));
                        $(element).attr("data-gr", (today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate()));
                        $(element).attr("data-hj", (g2h.hy + "-" + (g2h.hm + 1) + "-" + g2h.hd));
                        $(element).attr("data-dayOff", dayOff);
                        $(element).attr("data-food", food);
                        $(element).html(
                            "<b>" + count + "</b>" + "\n" +
                            "<span>" +
                            "<div class='font-fa tdinfo'>" +
                            g2h.hy + " " + hm2Txt(g2h.hm) + " " + g2h.hd +
                            "</div>" +
                            "<div class='font-eng tdinfo'>" +
                            gd2Txt(today.getDay()) + " " +
                            gm2Txt(today.getMonth()) + " " +
                            today.getDate() + " " +
                            today.getFullYear() +
                            "</div></span>" + res
                        )
                        ;
                        count++;
                    }
                },
                error: function () {
                    console.log("error!!!");
                }
            });
        }

        /* handle events */
        $(".fc-year").change(function () {
            _year = parseInt($(this).find(":selected").val());
            UpdateCal($(this).closest("table"), _year, _month, _day);
        });
        $(".fc-month").change(function () {
            _month = parseInt($(this).find(":selected").val());
            UpdateCal($(this).closest("table"), _year, _month, _day);
        });
        $(".fc-table td").on("click", function (e) {
            $tb = $(this).closest("table");
            $(".fc-table td span").popover("hide");
            if ($(this).attr("data-jl") && $(this).attr("data-gr")) {
                var title = "", content = "";
                _currDay = $(this);
                var jl = $(this).attr("data-jl").split("-");
                var wc = $(this).attr("data-gr").split("-");
                var hj = $(this).attr("data-hj").split("-");
                var time = wc[0] + "/" + wc[1] + "/" + wc[2];

                var date1 = new Date(wc);
                var date2 = new Date();
                var Difference_In_Time = date2.getTime() - date1.getTime();
                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                var dOf = $(this).attr("data-dayOff");
                if (Difference_In_Days > 0) {
                    dOf = 1;
                }
                $.ajax({
                    url: "https://farsicalendar.com/api/sh,wc,ic/" +
                        jl[2] + "," + wc[2] + "," + hj[2] + "/" + jl[1] + "," + wc[1] + "," + hj[1],
                    type: "GET",
                    dataType: 'json',
                    date: {limit: 3},
                    success: function (data) {
                        title = "رویدادهای امروز:";
                        content += "<ul>";
                        if (data.values.length == 0) {
                            content += "<li>" + "موردی یافت نشد" + "</li>";
                        } else {
                            $.each(data.values, function (index, item) {
                                if (item.dayoff == true) {
                                    content += "<li class='dayoff'>" + item.occasion + "</li>";
                                } else {
                                    content += "<li>" + item.occasion + "</li>";
                                }
                            });
                        }
                        content += "</ul>";
                        jQuery.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        })
                        userFinal = '';
                        $.ajax({
                            url: "{{route('foodDay.reserveListDay')}}",
                            type: "POST",
                            dataType: 'json',
                            data: {mYear: jl[0], mMonth: jl[1], mDay: jl[2]},
                            success: function (data) {
                                userFinal = '<ul>';
                                var food = '';
                                var price = '';
                                $.each(data, function (index, user) {
                                    $.each(user.users, function (index2, user2) {
                                        userFinal = userFinal + '<li>' + user2 + '</li>';
                                    });
                                    food = user.title;
                                    price = user.price;
                                });
                                userFinal = userFinal + '</ul>';
                                modalPopUp(time, jl[2], jl[1], jl[0], content, dOf, userFinal, food, price);
                            },
                            error: function () {
                                console.log("error!!!");
                            }
                        });


                        // $(_currDay).children("span").popover({
                        //     title: title,
                        //     content: content,
                        //     container: 'body',
                        //     placement: "bottom auto",
                        //     html: true
                        // });
                        // $(_currDay).children("span").popover("show");
                    },
                    error: function () {
                        console.log("error!!!");
                    }
                });
                e.preventDefault();
            }
        });

        /* helpers */
        function gd2Txt(day) {
            switch (day) {
                case 0:
                    return "Sun";
                    break;
                case 1:
                    return "Mon";
                    break;
                case 2:
                    return "Tue";
                    break;
                case 3:
                    return "Wed";
                    break;
                case 4:
                    return "Thu";
                    break;
                case 5:
                    return "Fir";
                    break;
                case 6:
                    return "Sat";
                    break;
                default:
                    return "خطا";
                    break;
            }
        }

        function gm2Txt(mon) {
            switch (mon) {
                case 0:
                    return "Jan";
                    break;
                case 1:
                    return "Feb";
                    break;
                case 2:
                    return "Mar";
                    break;
                case 3:
                    return "Apr";
                    break;
                case 4:
                    return "May";
                    break;
                case 5:
                    return "Jun";
                    break;
                case 6:
                    return "Jul";
                    break;
                case 7:
                    return "Aug";
                    break;
                case 8:
                    return "Sep";
                    break;
                case 9:
                    return "Oct";
                    break;
                case 10:
                    return "Nov";
                    break;
                case 11:
                    return "Dec";
                    break;
                default:
                    return "خطا";
                    break;
            }
        }

        function hm2Txt(mon) {
            switch (mon) {
                case 0:
                    return "محرم";
                    break;
                case 1:
                    return "صفر";
                    break;
                case 2:
                    return "ربیع الاول";
                    break;
                case 3:
                    return "ربیع الثانی";
                    break;
                case 4:
                    return "جمادی الاول";
                    break;
                case 5:
                    return "جمادی الثانی";
                    break;
                case 6:
                    return "رجب";
                    break;
                case 7:
                    return "شعبان";
                    break;
                case 8:
                    return "رمضان";
                    break;
                case 9:
                    return "شوال";
                    break;
                case 10:
                    return "ذی القعده";
                    break;
                case 11:
                    return "ذی الحجه";
                    break;
                default:
                    return "خطا";
                    break;
            }
        }

        function isoff(calType, mon, day) {
            var jlDayoff = [
                "1/1", "1/2", "1/3", "1/4", "1/12", "1/13",
                "3/14", "3/15", "11/22", "12/29"];
            var hjDayoff = [
                "1/9", "1/10", "2/20", "2/28", "2/30", "3/17", "6/3", "7/13",
                "7/27", "8/15", "9/21", "10/1", "10/2", "10/25", "12/10", "12/18"];

            mon += 1;
            if (calType == "jl") {
                if (jlDayoff.indexOf(mon + "/" + day) != -1)
                    return true;
                else
                    return false;
            }
            if (calType == "hj") {
                if (hjDayoff.indexOf(mon + "/" + day) != -1)
                    return true
                else
                    return false;
            }
        }
    </script>
@endpush
