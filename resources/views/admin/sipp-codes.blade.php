@extends('admin.home')

@section('content')
    @include('admin.menu')
    <div class="content">
        <div class="tittle-sipp">
            <h3>SIPP Codes</h3>
        </div>

       <div class="container-sipp">
           @foreach ($data['sipp_codes'] as $k_position =>$codes)
           <div class="box-sipp-code">Position {{$k_position}}
               <table class="table table-striped table-bordered">
                   <tr>
                       @foreach(array_keys($codes[0]) as $column_name)
                           @if($column_name == 'Code' || $column_name == 'Description')
                           <th><strong>{{ $column_name }}</strong></th>
                           @endif
                       @endforeach
                   </tr>

                   @foreach($codes as $code)
                       <tr>
                           @foreach($code as $k=>$value)
                               @if($k == 'Code')
                               <td>{{ $value }}</td>
                               @elseif($k == 'Description')
                                   <td>{{ $value }}</td>
                               @endif
                           @endforeach
                       </tr>
                   @endforeach
               </table>
           </div>
           @endforeach
       </div>
    </div>

@endsection

<style type="text/css">
    .container-sipp {
        width: 100%;
        height: auto;

        /*add flex style*/

        display: flex;
        flex-direction: row;
        justify-content: space-around;
        flex-flow: wrap;
    }
    .tittle-sipp {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .box-sipp-code {
        width: 200px;
        height: 300px;
        margin: 20px;
        font-size: 22px;
        text-align: center;
    }

    @media screen and (max-width: 1200px){
        .box-sipp-code{
            width: 40%;
            height: auto;
        }

    }

    @media screen and (max-width: 600px){
        .box-sipp-code{
            width: 90%;
            height: auto;
        }

    }

</style>