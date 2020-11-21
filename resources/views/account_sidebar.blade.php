
<div class="boxShadow">
    <div class="customerMenu">
        <h3>My Account</h3>
        <ul>
            <li class="{{ (request()->is('myaccount')) ? 'changeColor' : '' }}"><a href="/myaccount" class="personalInfo ">Personal Information</a></li>
            <li class="{{ (request()->is('myaccount/delete-account')) ? 'changeColor' : '' }}"><a href="/myaccount/delete-account" class="">Delete Account</a></li>
            <li class="{{ (request()->is('wishlist')) ? 'changeColor' : '' }}"><a href="/wishlist" class="">Wishlist</a></li>
            <li class="{{ (request()->is('help')) ? 'changeColor' : '' }}"><a href="/help " class="">Help</a></li>
        </ul>
    </div>
</div>
