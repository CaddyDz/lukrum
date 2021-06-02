const CancelToken = axios.CancelToken;

const imageUploaderCreator = () => {
    let uploads = [];
    return {
        add(key, form) {
            // Check If Existing, Cancel and Delete If So
            const k = uploads.findIndex((x) => {return x.key === key;});
            if(0 <= k) {
                const current = uploads[k];
                if(current.cancel) {
                    current.cancel();
                    current.cancel = null;
                }
                uploads.splice(k, 1);
            }

            const newItem = {key}
            newItem.promise = new Promise((resolve, reject) => {
                axios.post('/pmc/api/image/upload', form, {
                    headers: {'Content-Type': 'multipart/form-data',},
                    cancelToken: new CancelToken(function executor(c) {
                        // An executor function receives a cancel function as a parameter
                        newItem.cancel = c;
                    }),
                }).then(response => {
                    const k = uploads.findIndex((x) => {return x.key === key;});
                    if(0 <= k) {
                        uploads.splice(k, 1);
                    }
                    resolve(response);
                }).catch(e => {
                    reject(e);
                });
            });

            uploads.push(newItem);
        },

        done() {
            return new Promise((resolve, reject) => {
                if(0 === uploads.length) return resolve(true);
                Promise.all(uploads.map(x => x.promise)).then(x => {
                    resolve(x);
                }).catch(x => {
                    reject(x);
                })
            });
        }
    }
};

export default imageUploaderCreator();
