function POSTReq() {
  var form = document.getElementById('form')

    //var username = document.getElementById('email')
    var username = document.getElementById('email')
    var password = document.getElementById('password')

    var data = {username, password};
  
    fetch('https://gatesystemapi.herokuapp.com/api/login/', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
      }).then(async response => {
        try {
          if(response.status === 200){
            const jsonRes = await response.json();
            //await AsyncStorage.setItem('ktoken', jsonRes.token);
            //await AsyncStorage.setItem('id', String(jsonRes.id));
            var userToken = jsonRes.token;
            var userID = jsonRes.id;
            document.getElementById('userToken')
            document.getElementById('clock')
            console.log(`id: ${jsonRes.id}`);
            console.log(`token: ${userToken}`);
            //have a code na magnanavigate doon sa main screen
          } else if (response.status === 400) {
            console.log('login failed')
           } 
        } catch (err){
          console.log(err.message);
        }
      })
   

//end ito
}