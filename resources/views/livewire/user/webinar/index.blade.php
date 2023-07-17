<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-40">webinar</h4>
                    <div class="webinar-main">
                        @foreach($webinarRecords as $record)
                        <div class="webinar-item">
                            <div class="webinar-img">
                                <img src="{{ asset('images/package.png') }}" alt="package">
                            </div>
                            <div class="webinar-text">

                                <h5>{{$record->title}}</h5>
                                <ul>
                                    <li class="bg-light-orange">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.9922 3.50684H4.49219C3.66376 3.50684 2.99219 4.17841 2.99219 5.00684V15.5068C2.99219 16.3353 3.66376 17.0068 4.49219 17.0068H14.9922C15.8206 17.0068 16.4922 16.3353 16.4922 15.5068V5.00684C16.4922 4.17841 15.8206 3.50684 14.9922 3.50684Z" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.7422 2.00684V5.00684" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6.74219 2.00684V5.00684" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2.99219 8.00684H16.4922" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>{{convertDateTimeFormat($record->date)}}
                                    </li>
                                    <li class="bg-light-orange">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.74219 17.0068C13.8843 17.0068 17.2422 13.649 17.2422 9.50684C17.2422 5.3647 13.8843 2.00684 9.74219 2.00684C5.60005 2.00684 2.24219 5.3647 2.24219 9.50684C2.24219 13.649 5.60005 17.0068 9.74219 17.0068Z" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M9.74219 5.00684V9.50684L12.7422 11.0068" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> {{convertDateTimeFormat($record->time,'time')}}
                                    </li>
                                    <li class="bg-light-orange">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.7422 16.2568V14.7568C15.7422 13.9612 15.4261 13.1981 14.8635 12.6355C14.3009 12.0729 13.5378 11.7568 12.7422 11.7568H6.74219C5.94654 11.7568 5.18348 12.0729 4.62087 12.6355C4.05826 13.1981 3.74219 13.9612 3.74219 14.7568V16.2568" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M9.74219 8.75684C11.399 8.75684 12.7422 7.41369 12.7422 5.75684C12.7422 4.09998 11.399 2.75684 9.74219 2.75684C8.08533 2.75684 6.74219 4.09998 6.74219 5.75684C6.74219 7.41369 8.08533 8.75684 9.74219 8.75684Z" stroke="#464B70" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> Presenter : {{$record->presenter}}
                                    </li>
                                </ul>

                                <div class="content">
                                    {{strip_tags($record->description)}}
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{$webinarRecords->links('vendor.pagination.bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>