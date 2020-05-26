@extends('layouts.app')

@section('title', 'Rules — ' . config('app.name', 'Laravel') . ' — Space for your message')

@section('meta_tags')
<meta name="title" content="{{ 'Rules — ' . config('app.name', 'Laravel') . ' — Space for your message' }}">
<meta name="description" content="By using this website (the 'site'), you agree that you'll follow these rules, and understand that if we reasonably think you haven't followed these rules, we may (at our own discretion) terminate your access to the site:">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,rules,space,kara_sick,2019">
<meta name="robots" content="index,follow">
<meta property="og:title" content="{{ 'Help — ' . config('app.name', 'Laravel') . ' — Space for your message' }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
<meta property="og:image:secure_url" content="{{ asset('img/png/moondepth.dark.logo.png') }}" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="{{ route('rules.index') }}" />
<meta property="og:description" content="By using this website (the 'site'), you agree that you'll follow these rules, and understand that if we reasonably think you haven't followed these rules, we may (at our own discretion) terminate your access to the site:" />
<meta property="og:site_name" content="Moondepth" />
@endsection

@section('content')
<div id="back-button" class="container white-text">
    <a class="waves-effect waves-light grey darken-3 btn-large" href="{{ route('welcome.index') }}">
        <strong>RETURN TO THE HOME</strong>
    </a>
</div>
<div class="container center">
    <h1><strong>Rules</strong></h1>
</div>
<div class="container">

    <h3 class="justify-text-header"><u>{{ config('app.name', 'Laravel') . ' — Some tips to stay free'}}</u></h3>
    <p class="justify-text flow-text">By using this website (the "site"), you agree that you'll follow these rules, and understand that if we reasonably think you haven't followed these rules, we may (at our own discretion) terminate your access to the site:</p>
    <ol class="justify-text flow-text">
        <li>
            <p class="justify-text flow-text">You will not upload, post, discuss, request, or link to anything that violates local or Ukrainian law.</p>
        </li>
        <li>
            <p class="justify-text flow-text">You will immediately cease and not continue to access the site if you are under the age of 18.</p>
        </li>
        <li>
            <p class="justify-text flow-text">You will not post any of the following outside of /b/:</p>
            <ol>
                <li>
                    <p class="justify-text flow-text">Troll posts</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Racism</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Anthropomorphic ("furry") pornography</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Grotesque ("guro") images</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Loli/shota pornography</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Dubs or GET posts, including 'Roll for X' images</p>
                </li>
            </ol>
        </li>
        <li>
            <p class="justify-text flow-text">You will not post or request personal information ("dox") or calls to invasion ("raids"). Inciting or participating in cross-board (intra-Moondepth) raids is also not permitted.</p>
        </li>
        <li>
            <p class="justify-text flow-text">The quality of posts is extremely important to this community. Contributors are encouraged to provide high-quality images and informative comments. Please refrain from posting the following:</p>
            <ol>
                <li>
                    <p class="justify-text flow-text">Irrelevant catchphrases or copypasta. Example: "What the fuck did you just fucking say about me, you little bitch?..."</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Indecipherable text. Example: "lol u tk him 2da bar|?"</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Irrelevant ASCII macros</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Ironic shitposting. Example: "upboads for le funy maymay trollololololoxdxdxdxd~~!"</p>
                </li>
                <li>
                    <p class="justify-text flow-text">Gibberish text. Example: "l;kjdsfioasoiupwajnasdfa"</p>
                </li>
            </ol>
        </li>
        <li>
            <p class="justify-text flow-text">Submitting false or misclassified reports, or otherwise abusing the reporting system may result in a ban. Replying to a thread stating that you've reported or "saged" it, or another post, is also not allowed.</p>
        </li>
        <li>
            <p class="justify-text flow-text">Complaining about Moondepth (its policies, moderation, etc) on the imageboards may result in post deletion and a ban.</p>
        </li>
        <li>
            <p class="justify-text flow-text">Evading your ban will result in a permanent one. Instead, wait and appeal it!</p>
        </li>
        <li>
            <p class="justify-text flow-text">No spamming or flooding of any kind. No intentionally evading spam or post filters.</p>
        </li>
        <li>
            <p class="justify-text flow-text">Advertising (all forms) is not welcome—this includes any type of referral linking, "offers", soliciting, begging, stream threads, etc.</p>
        </li>
        <li>
            <p class="justify-text flow-text">Impersonating a Moondepth administrator, moderator, or janitor is strictly forbidden.</p>
        </li>
        <li>
            <p class="justify-text flow-text">Do not use avatars or attach signatures to your posts.</p>
        </li>
        <li>
            <p class="justify-text flow-text">The use of scrapers, bots, or other automated posting or downloading scripts is prohibited. Users may also not post from proxies, VPNs, or Tor exit nodes.</p>
        </li>
        <li>
            <p class="justify-text flow-text">All pony/brony threads, images, Flashes, and avatars belong on /mlp/.</p>
        </li>
        <li>
            <p class="justify-text flow-text">All request threads for adult content belong on /r/, and all request threads for work-safe content belong on /wsr/, unless otherwise noted.</p>
        </li>
        <li>
            <p class="justify-text flow-text">Do not upload images containing additional data such as embedded sounds, documents, archives, etc.</p>
            <br />
            <p class="">Copy & paste from 4chan.org</p>
        </li>
    </ol>
</div>
@endsection
