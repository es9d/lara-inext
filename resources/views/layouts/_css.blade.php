<!-- Stylesheets -->
<link type="text/css" href="{{ asset('assets/vendor/simplebar.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/css/app.css?v=1.0.0') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/css/vendor-material-icons.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/css/vendor-fontawesome-free.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/css/vendor-select2.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/css/vendor-flatpickr.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/css/vendor-flatpickr-airbnb.css') }}" rel="stylesheet">

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}" />
<style>
/* vietnamese */
@font-face {
  font-family: 'Lexend Deca';
  font-style: normal;
  font-weight: 400;
  src: local('Lexend Deca Regular'), local('LexendDeca-Regular'), url(https://fonts.gstatic.com/s/lexenddeca/v2/K2F1fZFYk-dHSE0UPPuwQ5qoJy_KZA.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Lexend Deca';
  font-style: normal;
  font-weight: 400;
  src: local('Lexend Deca Regular'), local('LexendDeca-Regular'), url(https://fonts.gstatic.com/s/lexenddeca/v2/K2F1fZFYk-dHSE0UPPuwQ5qpJy_KZA.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Lexend Deca';
  font-style: normal;
  font-weight: 400;
  src: local('Lexend Deca Regular'), local('LexendDeca-Regular'), url(https://fonts.gstatic.com/s/lexenddeca/v2/K2F1fZFYk-dHSE0UPPuwQ5qnJy8.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
.sidebar-menu-button ,h1.m-0{
    font-family:'Lexend Deca'
}
.btn{
    background-color:#0fe6b0 !important;
    border:0px!important;
}
.btn-light:hover{
  color:white !important;
}
.btn:hover{
    background-color:black !important;
    color : white;

}
[dir=ltr] .sidebar-light .active>.sidebar-menu-button>i,
[dir=ltr] .sidebar-light .active>.sidebar-menu-button>span{
    color:black !important;

}
</style>
<!-- company based preferences -->
@shared
<!-- END company based preferences -->

<!-- page based scripts & styles -->
@yield('page_head_scripts')
<!-- END page based scripts & styles -->
