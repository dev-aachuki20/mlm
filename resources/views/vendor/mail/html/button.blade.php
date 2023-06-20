<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="{{ $url }}" class="button button-{{ $color ?? 'primary' }}" target="_blank" style="font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
                                    box-sizing: border-box;
                                    border-radius: 3px;
                                    color: #fff;
                                    display: inline-block;
                                    text-decoration: none;
                                    background-color: #f24f00;
                                    border-top: 10px solid #f24f00;
                                    border-right: 18px solid #f24f00;
                                    border-bottom: 10px solid #f24f00;
                                    border-left: 18px solid #f24f00;
                                ">{{ $slot }}</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
