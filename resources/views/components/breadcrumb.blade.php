<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between p-3">
            @if(!isset($li_1))
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page" style="color: gray;">{{ $title }}</li>
                    </ol>
                </nav>
            @elseif(!isset($li_2))
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='gray'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class=" ms-3">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);" style="color: lightgray;">{{ $li_1 }}</a>
                        </li>
                        @if(isset($title))
                            <li class="breadcrumb-item active" aria-current="page" style="color: gray;">{{ $title }}</li>
                        @endif
                    </ol>
                </nav>
            @else
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='gray'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class=" ms-3">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);" style="color: lightgray;">{{ $li_1 }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);" style="color: lightgray;">{{ $li_2 }}</a>
                        </li>
                        @if(isset($title))
                            <li class="breadcrumb-item active" aria-current="page" style="color: gray;">{{ $title }}</li>
                        @endif
                    </ol>
                </nav>
            @endif
            
            <div class="align-items-center">
                <h3 class="me-3" style="color: lightgray;">{{ $title }}</h3>
            </div>

            <div></div>
            <!-- <h4 class="me-3" style="color: gray;">{{ $title }}</h4> -->
        </div>
    </div>
</div>
