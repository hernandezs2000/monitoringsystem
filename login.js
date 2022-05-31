function POSTReq() {
var form = document.getElementById('form')

form.addEventListener('submit',function(e){
    //auto submission of the form
    e.preventDefault()
    var username = document.getElementById('email')
    var password = document.getElementById('password')
    document.write(username)
    document.write(password)
  
    //fetch post req
    let userToken;
    userToken = null;
    fetch("https://gatesystemapi.herokuapp.com/api/login/", {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body:JSON.stringify({
            username:username,
            password:password
        })
    }).then(async response => {
        try {
            if(response.status === 200){
              const jsonRes = await response.json();
              await AsyncStorage.setItem('ktoken', jsonRes.token);
              await AsyncStorage.setItem('id', String(jsonRes.id));
              userToken = jsonRes.token;
              console.log(`id: ${jsonRes.id}`);
              console.log(`token: ${userToken}`);
              dispatch({ type: 'LOGIN', id: username, token: userToken});
            } else if (response.status === 400) {
              Alert.alert('Alert', 'User not found.', [
                {text:'OK', onPress: () => console.log('alert closed')}
              ]);
            }
          } catch (err){
            console.log(err.message);
          }
        })
      })

      useEffect(() => {
        let userToken;
        userToken = null;
        AsyncStorage.getItem('ktoken').then( ktoken => {
          userToken = ktoken;
          console.log(ktoken);
          dispatch({ type: 'RETRIEVE_TOKEN', token: userToken});
        });
      }, []);

}
//end ito
