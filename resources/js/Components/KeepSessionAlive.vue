<template>
</template>
<script>
function getTimer() {
    let timer, currentHash;
    const intervalPeriod = 300000;
    return {
        startTimer(hash, errorCallback) {

            let needToCreate = false;
            if(!timer) {
console.log("No Timer Exists");
                needToCreate = true;
            } else if(hash !== currentHash) {
console.log("Hash Mismatches");
                needToCreate = true;
                clearInterval(timer);
            }

            if(needToCreate) {
                const eHandler = e => {
                    let error = "Token Invalid";
                    switch(e.response.status) {
                        case 419:
                            error = "Token Expired";
                            alert("Security token expired. Please Refresh Page.");
                            break;

                        default:
                            alert("Something went wrong. Perhaps Refresh Page.");
                            break;
                    }
                    if(errorCallback) {
                        errorCallback(error);
                    }
                    // console.log(e.response);
                    if(timer) clearInterval(timer);
                }
                if(hash) {
                    timer = setInterval(async () => {
                        try {
                            const r = (await axios.post("/pmc/pre_payment_check", {hash})).data;
                            if(!r.ok) {
                                alert(r.error);
                                if(errorCallback) {
                                    errorCallback(r.error);
                                }
                                if(timer) clearInterval(timer);
                            }
                        } catch (e) {
                            eHandler(e);
                        }
                    }, intervalPeriod);
console.log("Timer Started [with hash]");
                } else {
                    timer = setInterval(async () => {
                        try {
                            const r = (await axios.post("/omc/check_token")).data;
                        } catch (e) {
                            eHandler(e);
                        }
                    }, intervalPeriod);
console.log("Timer Started [without hash]");
                }
            }
            currentHash = hash;
        },
        stopTimer() {
            if(timer) {
                clearInterval(timer);
console.log("Timer Stopped");
            }
            timer = null;
        }
    }
}
const timer = getTimer();

import {ref, onMounted, onUnmounted} from "vue";

export default {
    name: "KeepSessionAlive",
    props: ["hash", ],
    setup(props) {
        const sessionStatus = ref("Unknown");
        onMounted(() => {
console.log("Mounted");
            timer.startTimer(props.hash, function(x) {
                sessionStatus.value = x;
            });
        });
        onUnmounted(() => {
console.log("UnMounted");
            timer.stopTimer();
        })
        return {sessionStatus};
    }
}
</script>
