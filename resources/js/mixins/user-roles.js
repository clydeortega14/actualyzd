export default {
    methods: {
        checkRole(roles, check_value){
            if(Array.isArray(check_value)){
                
                for(let i =0; i < check_value.length; i++){
                    if(roles.includes(check_value[i])) return true;

                    else return false;
                }

            }else if(roles.includes(check_value)){
                console.log('not array')
                return true;
            }else{

                console.log('none at all')
                return false;
            }
        }
    }
}