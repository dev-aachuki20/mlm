<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="float-left">{{__('cruds.package.title_singular')}}</h4>
                    <button type="button" class="btn btn-sm btn-success btn-icon-text float-right">
                        <i class="ti-plus btn-icon-prepend"></i>                                                    
                            {{__('global.add')}}
                    </button>
                </div>                
                <div class="table-responsive">
                    <input type="text" wire:model.debounce.300ms="search" placeholder="Search by name...">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{__('global.sno')}}</th>
                            <th>{{__('cruds.package.fields.title')}}</th>
                            <th>{{__('global.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $key=>$package)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $package->title }}</td>
                                    <td>{{ $package->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>