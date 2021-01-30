var SoaxDepositTransaction = artifacts.require("./SoaxDepositTransaction.sol");
var ReceiverPays = artifacts.require("./ReceiverPays.sol");
var SoaxPurchase = artifacts.require("./SoaxPurchase.sol");

module.exports = function(deployer) {
//   deployer.deploy(SoaxDepositTransaction);
//   deployer.deploy(ReceiverPays);
  deployer.deploy(SoaxPurchase);
};
