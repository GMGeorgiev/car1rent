@extends('emails.main-mail-form')

@section('content')
    <style>
        .label, h2 {
            color: #bb1b1b;
        }

        table.data {
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table.data tr td.center {
            text-align: center;
        }

        table tr td.right {
            text-align: right;
        }

        table.data tr td {
            border: 1px solid #ccc;
            padding: 5px 10px;
        }
    </style>
    <div id="body-ma" class="container" style="">
        <table class="header" style="width: 100%">
            <tr>
                <td>

                </td>
                <td class="right">

                </td>
            </tr>
        </table>
        <h2>Car booking</h2>
        <table class="data" style="width: 100%">
            <tr>
                <td style="text-align: center ; font-weight: 600; font-size: 20px;">
                    <span class="label">Направена резервация: </span>
                </td>

            </tr>
            <tr>
                <td style="text-align: center; font-size: 19px;">
                    <span class="label">Ваучера е в прикачения файл.</span>
                </td>

            </tr>

        </table>

        <table class="data" style="width: 96%">
            <tr>
                <td class="center" style="width: 20px; font-weight: 700;"><span class="label">Contact</span></td>

            </tr>

            @if($data['rent_info']['car_info'])
                <tr>

                    <td class="center" style="width: 20px"><span class="label">{{  __('language.office')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->OfficeName}}</span></td>
                </tr>
                <tr>
                    <td class="center" style="width: 20px"><span class="label">{{  __('language.city')}}: {{$data['cities'][$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->CityID]}}</span></td>
                </tr>
                <tr>
                    <td class="center" style="width: 20px"><span class="label">{{  __('language.address')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->Address}}</span></td>
                </tr>
                <tr>
                    <td class="center" style="width: 20px"><span class="label">{{  __('language.phone')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->Phone}}</span></td>
                </tr>
                <tr>
                    <td class="center" style="width: 20px"><span class="label">{{  __('language.email')}}: {{$data['offices'][$data['rent_info']['car_info'][0]->OfficeID]->email}}</span></td>
                </tr>

            @endif

        </table>

    </div>
@endsection



