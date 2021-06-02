<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    @include("emails.inc.meow_css")
</head>
<body>
<table class="body">
    <tr>
        <td class="center" align="center" valign="top">
            <center data-parsed="">
                <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                            <table class="row grey"><tbody><tr>
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    &#xA0;
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                        </td></tr></tbody></table>

                <table class="container text-center"><tbody><tr><td> <!-- This container is the main email content -->
{{--                            <table class="row"><tbody><tr> <!-- Logo -->--}}
{{--                                    <th class="small-12 large-12 columns first last">--}}
{{--                                        <table>--}}
{{--                                            <tr>--}}
{{--                                                <th>--}}
{{--                                                    <center data-parsed="">--}}
{{--                                                        <a href="http://www.sendwithus.com" align="center" class="text-center">--}}
{{--                                                            <img src="https://www.sendwithus.com/assets/img/zurb-template-images/logo-placeholder.png" class="swu-logo" alt="Logo Image">--}}
{{--                                                        </a>--}}
{{--                                                    </center>--}}
{{--                                                </th>--}}
{{--                                                <th class="expander"></th>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                    </th>--}}
{{--                                </tr></tbody></table>--}}
                            <table class="row masthead"><tbody><tr> <!-- Masthead -->
                                    <th class="small-12 large-12 columns" style="padding:0;">
                                        <table>
                                            <tr>
                                                <th>
{{--                                                    <h1 class="text-center">Horizontal Right-Align</h1>--}}
                                                    <center data-parsed="">
                                                        <img src="https://res.cloudinary.com/pierry/image/upload/v1615884682/pmc/email/hg9get3ragnpbwlcnpnu.png" valign="bottom" alt="Masthead Image" align="center" class="text-center">
                                                    </center>
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                            <table class="row"><tbody><tr> <!--This row adds the gap between masthead and digest content -->
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    &#xA0;
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                            <table class="row"><tbody><tr> <!-- Horizontal Digest Content -->
                                    <th class="small-12 large-8 columns first" style="padding-left: 45px; padding-right: 75px;">
                                        <table>
                                            <tr>
                                                <th>
                                                    <p style="hyphens: none;">Dear {{$model->first_name}},</p>
                                                    <p style="hyphens: none;">Click <a target="_blank" href="{{url("pmc/asset/download/{$model->hash}")}}">here</a> to download your new file.</p>
                                                    <p style="hyphens: none;">
                                                        <b style="color: #3774B6;">Have you heard of Digital 360 from Salesforce?</b>
                                                        <b>It's a platform that connects all of your customer data—across teams, devices and systems—so you can really supercharge your business.</b>
                                                        Consider this your official invite for a demo.
                                                    </p>
                                                </th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                            <table class="row"><tbody><tr> <!-- Horizontal Digest Content -->
                                    <th class="small-12 large-6 columns first" style="padding-left: 45px;padding-right: 30px;">
                                        <table>
                                            <tr>
                                                <th>
                                                    <p style="hyphens: none;">Forget fiddly, conflicting data. Digital 360 helps cut the noise that can come with having multiple data sources (we all know what that's like), so you can get on with achieving your business goals.</p>
                                                    <p style="hyphens: none;">I look forward to showing you how the world's #1 CRM can work for your business. In the meantime, please don't hesitate to reach out with any questions. </p>
                                                </th>
                                            </tr>
                                        </table>
                                    </th>
                                    <th class="small-12 large-5 columns last">
                                        <table>
                                            <tr>
                                                <th>
                                                    <img src="https://res.cloudinary.com/pierry/image/upload/v1615884785/pmc/email/hy9zqkn1wklyevmkchdd.png" alt="Feature Image">
                                                </th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                        </td></tr></tbody></table> <!-- End main email content -->

                <table class="container text-center"><tbody><tr><td> <!-- Footer -->
                            <table class="row"><tbody><tr>
                                    <th class="small-12 large-12 columns first last" style="padding-left: 45px; padding-right: 75px;">
                                        <table>
                                            <tr>
                                                <th>
                                                    <p class="footercopy" style="hyphens: none;">
                                                        This email is sent to you from the above featured company. If you don't want to receive these emails from the above featured company, <a target="_blank" href="{{ url("pmc/unsubscribe?e={$model->email}&h={$model->last8OfHash()}") }}">unsubscribe here</a>.
                                                        <br /><br />
                                                        Pierry Inc. 785 Broadway. Redwood City, CA. 94063. Tel (123) 456-7990
                                                    </p>
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                        </td></tr></tbody></table>

                <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                            <table class="row grey"><tbody><tr>
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    &#xA0;
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                        </td></tr></tbody></table>

            </center>
        </td>
    </tr>
</table>
</body>
</html>

{{--
  -storage: array:18 [
    "asset_id" => "5cab3ed0ef230c3be00e1bb527a3ccb5"
    "public_id" => "pmc/email/hg9get3ragnpbwlcnpnu"
    "version" => 1615884682
    "version_id" => "551e94a9f43a88d56ccd3c4355c1e5ac"
    "signature" => "0a8be1a8c2be7c7fa07e46ec5cedf16806ed3733"
    "width" => 600
    "height" => 259
    "format" => "png"
    "resource_type" => "image"
    "created_at" => "2021-03-16T08:51:22Z"
    "tags" => []
    "bytes" => 30963
    "type" => "upload"
    "etag" => "360d0bed0f537931aada34309ec95819"
    "placeholder" => false
    "url" => "http://res.cloudinary.com/pierry/image/upload/v1615884682/pmc/email/hg9get3ragnpbwlcnpnu.png"
    "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1615884682/pmc/email/hg9get3ragnpbwlcnpnu.png"
    "original_filename" => "email_top"
  ]

  -storage: array:18 [
    "asset_id" => "852df3e61c42fd610f8d6a8c505a96b0"
    "public_id" => "pmc/email/hy9zqkn1wklyevmkchdd"
    "version" => 1615884785
    "version_id" => "f64cb65ed1253a50cc5051efbd6cdeb3"
    "signature" => "59c30035434a79698a2dbb50ef948e22fff89a54"
    "width" => 259
    "height" => 270
    "format" => "png"
    "resource_type" => "image"
    "created_at" => "2021-03-16T08:53:05Z"
    "tags" => []
    "bytes" => 52513
    "type" => "upload"
    "etag" => "4b8aa588ea6cfdf912d93cef95c0c5cf"
    "placeholder" => false
    "url" => "http://res.cloudinary.com/pierry/image/upload/v1615884785/pmc/email/hy9zqkn1wklyevmkchdd.png"
    "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1615884785/pmc/email/hy9zqkn1wklyevmkchdd.png"
    "original_filename" => "email_discover"
  ]

--}}
