let data = null;

const loadData = async () => {
    return (await axios.post('/instance/frontend')).data;
}

import defaults from './instanceDefault';
const loader = () => {
    return new Promise(async (resolve, reject) => {
        if(data) return resolve(data);
        try {
            data = await loadData();
            if(!data) data = defaults;
            resolve(data);
        } catch (e) {
            data = defaults;
            resolve(data);
            // reject(e);
        }
    });
};
export default loader;
