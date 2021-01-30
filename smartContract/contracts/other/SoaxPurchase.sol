pragma solidity ^0.5.11;

contract SoaxPuerchase{
    mapping(address => uint) balance;

    constructor() public payable{}
    function invest() external payable{
        // if(msg.value < 1 ether){
        //     revert();
        // }
        balance[msg.sender] += msg.value;
    }

    function balanceOf() external view returns(uint){
        return address(this).balance;
    }

    function transferEther(address payable recipient) external {
          recipient.transfer(1);
      }

 }
