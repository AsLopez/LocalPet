//const SHA256 = require('crypto-js/sha256');
//const SHA256 = <script type="text/javascript" src="crypto-js/sha256.js"> </script>
class Transaction{
    constructor(Desde, Hacia, mascota){
        this.Desde = Desde;
        this.Hacia = Hacia;
        this.mascota = mascota;
    }
}

class Block {
    constructor(timestamp, transactions, previousHash = '') {
        this.previousHash = previousHash;
        this.timestamp = timestamp;
        this.transactions = transactions;
        this.hash = this.calculateHash();
        this.nonce = 0;
    }

    calculateHash() {
        //return hash($256, this.previousHash + this.timestamp + JSON.stringify(this.transactions) + this.nonce, true).toString();
        return hash('sha256', 'this.previousHash + this.timestamp + JSON.stringify(this.transactions) + this.nonce').toString();
    }

    mineBlock(difficulty) {
        while (this.hash.substring(0, difficulty) !== Array(difficulty + 1).join("0")) {
            this.nonce++;
            this.hash = this.calculateHash();
        }

        console.log("BLOQUE MINADO: " + this.hash);
    }
}


class Blockchain{
    constructor() {
        this.chain = [this.createGenesisBlock()];
        this.difficulty = 2;
        this.pendingTransactions = [];
        this.miningReward = 100;
    }

    createGenesisBlock() {
        return new Block(Date.parse("2017-01-01"), [], "0");
    }

    getLatestBlock() {
        return this.chain[this.chain.length - 1];
    }

    minePendingTransactions(miningRewardAddress){
        let block = new Block(Date.now(), this.pendingTransactions, this.getLatestBlock().hash);
        block.mineBlock(this.difficulty);

        console.log('BLOQUE MINADO!!!');
        this.chain.push(block);

        this.pendingTransactions = [
            //new Transaction(null, miningRewardAddress, this.miningReward)
        ];
    }

    createTransaction(transaction){
        this.pendingTransactions.push(transaction);
    }

    getBalanceOfAddress(address){
        let balance = 0;

        for(const block of this.chain){
            for(const trans of block.transactions){
                if(trans.Desde === address){
                    balance -= trans.mascota;
                }

                if(trans.Hacia === address){
                    balance += trans.mascota;
                }
            }
        }

        return balance;
    }

    isChainValid() {
        for (let i = 1; i < this.chain.length; i++){
            const currentBlock = this.chain[i];
            const previousBlock = this.chain[i - 1];

            if (currentBlock.hash !== currentBlock.calculateHash()) {
                return false;
            }

            if (currentBlock.previousHash !== previousBlock.hash) {
                return false;
            }
        }

        return true;
    }
}

let Moneda = new Blockchain();
Moneda.createTransaction(new Transaction('Jose', 'Carlos', 'Gato'));
Moneda.createTransaction(new Transaction('Carlos', 'Jose', 'Perro'));

console.log('\n Iniciando minero...');
Moneda.minePendingTransactions('Jose');
Moneda.minePendingTransactions('Jose');
Moneda.minePendingTransactions('Jose');

//console.log('\nBalance de Jose es:', Moneda.getBalanceOfAddress('Jose'));

//console.log('\n Iniciando minero de nuevo...');
//Moneda.minePendingTransactions('Jose');

//console.log('\nBalance de Jose es:', Moneda.getBalanceOfAddress('Jose'));

//console.log(JSON.stringify(Moneda, null, 4));
console.log(JSON.stringify(Moneda, null, 2));