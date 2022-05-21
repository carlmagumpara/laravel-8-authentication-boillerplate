@if (Auth::check())
<script type="text/javascript">
  window.Echo.join('global')
  .here(users => {
    console.log('online now', users);
    // window.axios.post('/user/presence', {
    //   status: 'online',
    //   latitude: 0,
    //   longitude: 0,
    // });
  })
  .joining(user => {
    console.log('joining here', user);
    // window.axios.post('/user/presence', {
    //   user_id: user.user_id,
    //   status: 'online',
    // });
  })
  .leaving(user => {
    console.log('leaving here',user);
    // window.axios.post('/user/presence', {
    //   user_id: user.user_id,
    //   status: 'offline',
    // });
  })
  .listen('UserOnlineEvent', data => {
    // console.log('UserOnlineEvent', data);
  })
  .listen('UserOfflineEvent', data => {
    // console.log('UserOfflineEvent', data);
  });
</script>
@endif