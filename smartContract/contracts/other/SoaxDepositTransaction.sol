pragma solidity ^0.5.0;

contract SoaxDepositTransaction {
  uint public totalTransactions = 0;
  uint amount = 2;
  struct SoaxTransaction {
    uint id;
    uint transacionId;
    uint user_id;
    string owner_name;
    string owner_address;
    string sender_name;
    string sender_address;
    string soax_amount;
  }

  mapping(uint => SoaxTransaction) public soaxTransactions;

  constructor() public {

  }

  function newSoaxTransaction(
    uint transacionId,
    uint user_id,
    string memory owner_name,
    string memory owner_address,
    string memory sender_name,
    string memory sender_address,
    string memory soax_amount
  ) public payable {
    totalTransactions++;
    amount += msg.value;
    soaxTransactions[totalTransactions] = SoaxTransaction(
      totalTransactions,
      transacionId,
      user_id,
      owner_name,
      owner_address,
      sender_name,
      sender_address,
      soax_amount
    );
  }
}
