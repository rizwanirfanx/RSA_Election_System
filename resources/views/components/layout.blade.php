<html>

<head>
    <title>{{ $title ?? 'ECP Admin Page' }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <section class="grid grid-cols-12">
        <div class="sidebar col-span-3 bg-slate-900 text-white px-3 py-2 min-h-screen">
            <div class="flex items-center">
                <a href="/">

                    <img alt="logo" src="{{ asset('images/gov_white_logo.png') }}" width="100px">
                </a>
            </div>
            <div class="my-5"></div>
            <x-nav-components.nav-button rexParent="national_assembly" title="National Assembly" link="#"
                icon="fa-democrat" />
            <x-nav-components.nav-button rexChild="national_assembly-child" class="bg-red-700" title="Add NA Candidate" link="/admin/add_na_candidate"
                icon="fa-person" />
            <x-nav-components.nav-button rexChild="national_assembly-child" title="Display NA Candidates" link="/admin/na_candidates" icon="fa-users" />
            <x-nav-components.nav-button rexChild="national_assembly-child" title="Add NA Seat" link="/admin/add_na_seat" icon="fa-chair" />
            <x-nav-components.nav-button rexChild="national_assembly-child" title="Display NA Seats" link="/admin/display_na_seats" icon="fa-eye" />
            <x-nav-components.nav-button rexParent="provincial_assembly" title="Provincial Assembly" link="#" icon="fa-person" />
            <x-nav-components.nav-button rexChild="provincial_assembly-child" title="Add PA Candidate" link="/admin/add_pa_candidate" icon="fa-person" />
            <x-nav-components.nav-button rexChild="provincial_assembly-child" title="Display PA Candidates" link="/admin/pa_candidates" icon="fa-users" />
            <x-nav-components.nav-button  rexChild="provincial_assembly-child" title="Add PA Seat" link="/admin/add_pa_seat" icon="fa-chair" />
            <x-nav-components.nav-button rexChild="provincial_assembly-child" title="Display PA Seats" link="/admin/display_pa_seats" icon="fa-eye" />
            <x-nav-components.nav-button title="Display Parties" link="/admin/parties" icon="fa-landmark" />
            <x-nav-components.nav-button title="Add NADRA Verification Details"
                link="/admin/add_nadra_verification_details" icon="fa-landmark" />
            <x-nav-components.nav-button title="Settings" link="/admin/settings" icon="fa-gear" />
            <x-nav-components.nav-button title="Display Results" link="/admin/display_results" icon="fa-chart-simple" />
            <x-nav-components.nav-button title="Logout" link="/logout" icon="fa-right-from-bracket" />
        </div>
        <div class="bg-gray-300 col-span-9">
            <nav class="bg-gray-100 p-4">
                <div class="flex">
                    <div class="left">
                        <h3 class="font-semibold text-2xl fami">Welcome {{ Auth::user()->name }} 🎊</h3>
                        <p class="text-gray-800 font-light text-sm mt-2">Welcome to Modern Elections (Transparent, Fast,
                            Private & Secure ! )</p>
                    </div>
                    <div class="right">
                    </div>
                </div>
            </nav>
            <div class="mt-4 mx-4">
                {{ $slot }}
            </div>
        </div>
    </section>
</body>
{{ $script ?? '' }}
<script>
    let parent = document.querySelectorAll('[data-rex-parent]')

    let child = (document.querySelector('[data-rex-child]'))


    let parents = [...parent]



    parents.forEach((parent) => {
        parent.addEventListener('click', (e) => {
            let parentPrefix = parent.dataset.rexParent
            let children = (document.querySelectorAll(`[data-rex-child=${parentPrefix}-child`))
            children.forEach(child => {
                child.classList.toggle('hidden')
            })
        })
    })
</script>

</html>
