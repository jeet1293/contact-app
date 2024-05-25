<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Contact List <span class="text-muted fw-normal ms-2">({{ $count }})</span></h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                
                    <div>
                        <a href="{{ route('contact.create') }}"class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add New
                        </a>
                        <a href="{{ route('contact.export') }}"class="btn btn-primary">
                            Export All
                        </a>
                    </div>
                    {{-- <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary">Manage Tags</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <p>Include Tags</p>
                <ul id="included">
                    @foreach($tags as $tag)
                        <li id="{{ 'tag-'.$tag->tag }}" data-value="{{ $tag->tag }}" style="cursor:pointer" > {{ $tag->tag }} </li>
                    @endforeach
                </ul>

                <p>Exclude Tags</p>
                <ul id="excluded">
                    @foreach($tags as $tag)
                        <li id="{{ 'tag-'.$tag->tag }}" data-value="{{ $tag->tag }}" style="cursor:pointer" > {{ $tag->tag }} </li>
                    @endforeach
                </ul>

            </div>
            <div class="col-lg-8">
                <div class>
                    <div class="table-responsive">
                        <table id="contactListTable" class="table project-list-table table-nowrap align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4" style="width: 50px;">
                                        <div class="form-check font-size-16"><input type="checkbox"
                                                class="form-check-input" id="contacusercheck" /><label
                                                class="form-check-label" for="contacusercheck"></label></div>
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Tags</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td scope="col" class="ps-4" style="width: 50px;">
                                            <div class="form-check font-size-16"><input type="checkbox"
                                                class="form-check-input" id="contacusercheck" /><label
                                                class="form-check-label" for="contacusercheck"></label></div>
                                        </td>
                                        <td>
                                            <img src='{{ asset('storage/photos/'.$contact->photo) }}'
                                                class='avatar-sm rounded-circle me-2' />
                                                <span class='text-body'>{{ $contact->name }}</span>

                                        <td>{{ $contact->phone }}</td>
                                        <td>
                                            @foreach ($contact->tags as $tag)
                                                <span class='badge badge-soft-info mb-0'>{{ $tag->tag }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td>No data found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("ul[id*=included] li").click(function() {
            let tag = $(this).attr('data-value');

            // Fetch current URL
            var currentUrl = window.location.href;

            // Example of updating or adding a parameter
            var updatedUrl = updateUrlParam(currentUrl, 'included', tag);

            console.log(updatedUrl);
        });

        // Function to get URL parameters
        function getUrlParams(url) {
            var params = {};
            var parser = document.createElement('a');
            parser.href = url;
            var query = parser.search.substring(1);
            var vars = query.split('&');
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split('=');
                params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
            }
            return params;
        }

        function updateUrlParam(url, key, value) {
            var parser = document.createElement('a');
            parser.href = url;
            var params = getUrlParams(url);
            
            // Check if the parameter already exists
            if (params.hasOwnProperty(key)) {
                // If it exists, update its value
                params[key] = value;
            } else {
                // If it doesn't exist, add it to the parameters
                params[key] = value;
            }
            
            // Remove the old parameter key if it exists with undefined value
            delete params[""];

            var updatedParams = $.param(params);
            var updatedUrl = parser.origin + parser.pathname + '?' + updatedParams + parser.hash;

            // Update the URL
            window.location.href = updatedUrl;
        }
    </script>
</body>

</html>
