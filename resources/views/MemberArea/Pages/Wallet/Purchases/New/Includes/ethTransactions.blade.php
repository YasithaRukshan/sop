<script src="https://unpkg.com/@metamask/detect-provider/dist/detect-provider.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereumjs/browser-builds/dist/ethereumjs-tx/ethereumjs-tx-1.3.3.min.js">
</script>
<script>
    EThAppDeploy = {
        loadWeb3: async (data) => {
            if (typeof web3 !== 'undefined') {
                if (web3.currentProvider.networkVersion == data.chain_id) {
                    EThAppDeploy.web3Provider = web3.currentProvider;
                    web3 = new Web3(web3.currentProvider);
                    EThAppDeploy.runEthereumFunctions(data, web3);
                } else {
                    loader(false);
                    error(
                        "Please Make Sure You are sending though the mainNet. Test Network Transactions are not allowed"
                    );
                }
            } else {
                loader(false);
                error(
                    "Not able to locate an Ethereum connection, please install a Ethereum wallet like Metamask or TrustWallet <br> Or You may try with Bitcoin Option"
                );
            }

        },
        runEthereumFunctions: async (data, web3) => {
            const provider = await detectEthereumProvider();
            provider.autoRefreshOnNetworkChange = false;
            if (provider) {
                ethereum
                    .request({
                        method: 'eth_requestAccounts'
                    })
                    .then((resp) => {
                        //if connected run next actions
                        EThAppDeploy.payNow(data, web3);
                    })
                    .catch((err) => {
                        // Some unexpected error.
                        // For backwards compatibility reasons, if no accounts are available,
                        // eth_accounts will return an empty array.
                        error(err);
                        loader(false);
                    });

            } else {
                // handle no provider
                error("Please login a Ethereum wallet like Metamask or TrustWallet");
                loader(false);
            }
        },
        /***
         *
         *Deployee new Contract with new customer
         * */
        payNow: async (data, web3) => {
            var inWei = web3.toWei(data.value, 'ether');
            web3.eth.sendTransaction({
                to: data.master_acc,
                value: inWei,
                chainId: data.chain_id,
            }, (err, hash) => {
                if (!err) {
                    sendCallbackOnInvestSuccess({
                        hash: hash,
                        depkey: data.depkey,
                        id: data.id,
                    });
                } else {
                    loader(false);
                }
            });
        },
    }

</script>
