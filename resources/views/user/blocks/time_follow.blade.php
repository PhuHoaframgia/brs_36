<h2>{{ trans('master.activities_of_follower') }}</h2>
<!-- follower active -->
<div class="contentacti" >
    <table>
        @foreach ($activities as $activity)
            <tr>
                <td>{{ Html::image('user/img/page1_pic2.jpg','a picture', ['class' => 'imguser']) }}
                </td>
                <td><a class="sub-contentaci">{{ $activity['title'] }}</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
