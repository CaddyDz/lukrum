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
                            <table class="row"><tbody><tr> <!-- Horizontal Digest Content -->
                                    <th class="small-12 large-8 columns first" style="padding-left: 45px; padding-right: 75px;">
                                        <table>
                                            <tr>
                                                <th>
                                                    <p style="hyphens: none;">Dear manager,</p>
                                                    <br />
                                                    @foreach($f as $file)
                                                        <p><a href="{{ $file['s3_url'] }}">Download {{$file['file_name']}}</a></p>
                                                    @endforeach
                                                    <br />

                                                    <p>First Name : {{$m->first_name}}</p>
                                                    <p>Last Name : {{$m->last_name}}</p>
                                                    <p>Company : {{$m->company}}</p>
                                                    <p>Title : {{$m->job_title}}</p>
                                                    <p>Email address : {{$m->email}}</p>
                                                    <p>Phone Number : {{$m->phone}}</p>
                                                    <p>Country : {{$m->country}}</p>
                                                    <p>City : {{$m->city}}</p>
                                                    <p>State/Province : {{$m->state}}</p>
                                                    <p>Zip/Postal Code : {{$m->zip_code}}</p>
                                                    <p>Mailing Address : {{$m->address}}</p>
                                                    <p>Company URL : {{$m->company_url}}</p>
                                                    <p>Program : {{$m->program}}</p>
                                                    <p>Navigator Level : {{$m->navigation_level}}</p>
                                                    <p>Campaign Focus : {{$cib->focus}}</p>
                                                    <p>Additional Comments : {{$m->comments}}</p>
                                                    <p>Launch Date : {{$m->launch_date}}</p>
                                                    <p>Submission Date : {{$m->submission_date}}</p>

                                                    <hr>

                                                @foreach($touchpoints as $tpCode => $tpInfo)
                                                    <h4>{{$tpInfo['title']}} Touchpoint</h4>
                                                    @if(in_array('banner', $tpInfo['steps']))
                                                        <h6 style="padding-left: 20px">Banner Copy</h6>
                                                        <?php $edited = "{$tpCode}_ads_headline_edited"; $original = "{$tpCode}_ads_headline_original"; ?>
                                                        <p style="padding-left: 40px;">Subheading : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <?php $edited = "{$tpCode}_ads_cta_edited"; $original = "{$tpCode}_ads_cta_original"; ?>
                                                        <p style="padding-left: 40px;">Call to Action : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <br />
                                                    @endif
                                                    @if(in_array('sm', $tpInfo['steps']))
                                                        <h6 style="padding-left: 20px">Social Copy</h6>
                                                        <?php $edited = "{$tpCode}_sm_headline_edited"; $original = "{$tpCode}_sm_headline_original"; ?>
                                                        <p style="padding-left: 40px;">Subheading : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <?php $edited = "{$tpCode}_sm_cta_edited"; $original = "{$tpCode}_sm_cta_original"; ?>
                                                        <p style="padding-left: 40px;">Call to Action : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <br />
                                                    @endif
                                                    @if(in_array('landing', $tpInfo['steps']))
                                                        <h6 style="padding-left: 20px">Landing Page Copy</h6>
                                                        <?php $edited = "{$tpCode}_ld_headline_edited"; $original = "{$tpCode}_ld_headline_original"; ?>
                                                        <p style="padding-left: 40px;">Subheading : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <?php $edited = "{$tpCode}_ld_intro_edited"; $original = "{$tpCode}_ld_intro_original"; ?>
                                                        <p style="padding-left: 40px;">Intro : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <?php $edited = "{$tpCode}_ld_body_edited"; $original = "{$tpCode}_ld_body_original"; ?>
                                                        <p style="padding-left: 40px;">Body : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <?php $edited = "{$tpCode}_ld_cta_edited"; $original = "{$tpCode}_ld_cta_original"; ?>
                                                        <p style="padding-left: 40px;">Call to Action : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <br />
                                                    @endif
                                                    @if(in_array('email', $tpInfo['steps']))
                                                        <h6 style="padding-left: 20px">Email Copy</h6>
                                                        <?php $edited = "{$tpCode}_email_intro_edited"; $original = "{$tpCode}_email_intro_original"; ?>
                                                        <p style="padding-left: 40px;">Subheading : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <?php $edited = "{$tpCode}_email_body_edited"; $original = "{$tpCode}_email_body_original"; ?>
                                                        <p style="padding-left: 40px;">Body : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <?php $edited = "{$tpCode}_email_cta_edited"; $original = "{$tpCode}_email_cta_original"; ?>
                                                        <p style="padding-left: 40px;">Call to Action : {{$cib->{$edited} ? $cib->{$edited} : $cib->{$original} }}</p>
                                                        <br />
                                                    @endif

                                                    <hr />
                                                @endforeach
                                                    @if($questions)
                                                        <br />
                                                        <h4>Customer Success Story</h4>
                                                        @foreach(range(1, 6) as $idx)
                                                            <?php $question = "question{$idx}"; $answer = "answer{$idx}"; ?>
                                                                <h6 style="padding-left: 20px">{{ $cib->{$question} }}</h6>
                                                                <p style="padding-left: 40px;">{{ $cib->{$answer} }}</p>
                                                        @endforeach

                                                        <br /><br />
                                                        <h4>Ask the Expert</h4>
                                                        @foreach(range(7, 11) as $idx)
                                                            <?php $question = "question{$idx}"; $answer = "answer{$idx}"; ?>
                                                            <h6 style="padding-left: 20px">{{ $cib->{$question} }}</h6>
                                                            <p style="padding-left: 40px;">{{ $cib->{$answer} }}</p>
                                                        @endforeach
                                                    @endif
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
                                                        <br />
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
