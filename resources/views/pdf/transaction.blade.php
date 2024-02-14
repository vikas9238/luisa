@inject('transaction','App\Transaction')
@inject('transactionAccount','App\TransactionAccount')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Transaction</title>
        <style>
            @page {
                margin: 100px 25px;
                font-family: 'helvetica';
                font-size: 12px !important;

            }
            header {
                margin: 0px 0px;
                position: fixed;
                top: -80px;
                left: 0px;
                right: 0px;
                height: 70px;
                font-size: 20px !important;

                /** Extra personal styles **/
                background-color: #f03c02 !important;
                color: white;
                text-align: center;
                /*line-height: 3px;*/
            }

            footer {
                position: fixed; 
                bottom: -80px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 15px !important;

                /** Extra personal styles **/
                background-color: #f03c02 !important;
                color: white;
                text-align: center;
                line-height: 35px;
            }    
            .dotted {border: 1px dotted black; border-style: none none dotted; background-color: #fff; }

        </style>
    </head>
    <body>
        <header>
            <table style="width:100%;padding: 0px;margin: 0px;"> 
                <tr>
                    <td valign="top" align="left">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        <span style="font-size:20px;font-weight:bold;">
                                            {{ $companySetting->company_name }}
                                        </span>
                                        <br>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" align="right">
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td align="right" valign="top">
                                        <span style="font-size:20px;font-weight:bold;">
                                            Transaction
                                        </span>
                                        <br>
                                        <span style="font-size:small;align:center;">
                                           {{ $member->full_name }}({{ $member->customer_id }})
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>

        </header>
        <footer>
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td align="center">
                            <span style="font-size:small;">
                                Reg. Office : {{ $companySetting->company_address ?? 'N/A' }} &nbsp;
                            </span>
                            <span style="font-size:small;">Phone Number : {{ $companySetting->company_contact_number ?? '' }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </footer>
        <div class="row">
            <table style="width:100%;">
                <thead>
                    <tr>
                        <th align="left">{{ __("Date") }}</th>
                        <th align="left">{{ __("Remarks") }}</th>
                        <th align="left">{{ __("Mode") }}</th>
                        <th align="left">{{ __("Cheque/Ref Number") }}</th>
                        <th align="right">{{ __("Credit") }}</th>
                        <th align="right">{{ __("Debit") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resultSets as $key => $resultSet)
                    <tr>
                        <td width="15%" align="left" valign="top">
                            {{ GeneralHelper::pfgDate($resultSet->transaction_date) }}
                        </td>
                        <td align="left" valign="top">
                            {{ $resultSet->remarks ?? 'N/A' }}
                        </td>
                        <td align="left" valign="top">
                            {{ $transaction::PAY_MODE[$resultSet->pay_mode] }}
                        </td>
                        <td width="30%" class="text-left" valign="top">
                            @if ($resultSet->pay_mode == $transaction::PAY_MODE_CHEQUE)
                            {{ $resultSet->cheque_number }}
                            @elseif ($resultSet->pay_mode == $transaction::PAY_MODE_ONLINE_TRANSFER)
                            {{ $resultSet->reference_number }}
                            @else
                            {{ __("N/A") }}
                            @endif
                        </td>
                        <td align="right" valign="top">
                            @if($resultSet['transaction_type'] == $transaction::TRANSACTION_TYPE_CREDIT)
                            <span class="text-success">
                                {{ GeneralHelper::twoDecimal($resultSet->transaction_amount) }}
                            </span>
                            @endif
                        </td>
                        <td align="right" valign="top">
                            @if($resultSet['transaction_type'] == $transaction::TRANSACTION_TYPE_DEBIT)
                            <span class="text-danger" >
                                {{ GeneralHelper::twoDecimal($resultSet->transaction_amount) }}  
                            </span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>