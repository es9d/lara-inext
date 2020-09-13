@extends('emails.layout')

@section('title', $subject)

@section('content')
    <table style="width: 100%; color: #434245;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="box-sizing: border-box;">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <!--[if mso]>
                                <table cellpadding="0" cellspacing="0" border="0" style="padding: 0; margin: 0; width: 100%;">
                                    <tr>
                                        <td colspan="3" style="padding: 0; margin: 0; font-size: 20px; height: 20px;" height="20">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0; margin: 0;">&nbsp;</td>
                                        <td style="padding: 0; margin: 0;" width="540">
                            <![endif]-->
                                            <img style="width: 195px; margin: 0 0 15px 0; padding-right: 30px; padding-left: 30px;" width="195" src="{{ $company->avatar }}" />

                                            {!! $mail_content !!}
                            <!--[if mso]>
                                        </td>
                                        <td style="padding: 0; margin: 0;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="padding: 0; margin: 0; font-size: 20px; height: 20px;" height="20">&nbsp;</td>
                                    </tr>
                                </table>
                            <![endif]-->

                            <div style="padding-right: 30px; padding-left: 30px;">
                                <div style=" padding: 30px 0 22px; margin: 0; padding-top: 20px;">
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
