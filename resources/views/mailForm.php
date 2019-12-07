Lor Verification Mail

이 메일은 LOR 메일인증을 위한 메일입니다.

아래의 링크로 들어가서 인증해주세요!

Link: 192.168.43.190:8000/verification/{{$verificate}}

<a href="{{route('register.confirm', $user->confirm_code)}}">{{route('register.confirm', $user->confirm_code)}}</a>

Link: 192.168.43.190:8000/verification/<?php echo $verificate ?>
