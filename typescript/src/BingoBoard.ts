class Cell {
  private readonly _value: string | null;
  private marked: boolean;
  constructor (value: string | null){
    this._value = value
    this.marked = false
  }

  get value(){
    return this._value
  }

  mark(){
    this.marked = true
  }
  
  isMarked(): boolean {
    return this.marked
  }
}

export class Coordinate {
  public readonly x: number;
  public readonly y: number;

  constructor(x: number, y: number){
    this.x = x;
    this.y = y;
  }
}

export class BingoBoard {
  private readonly theCells: Cell[][];

  constructor(width: number, height: number) {
    this.theCells = Array.from({ length: width }, () =>
      Array.from({ length: height }, () => new Cell(null))
    );
  }

  defineCell(position: Coordinate, value: string): void {
    if (this.theCells[position.x][position.y].value !== null) {
      throw new Error("cell already defined");
    }

    for (let c = 0; c < this.theCells.length; c++) {
      for (let r = 0; r < this.theCells[c].length; r++) {
        if (value === this.theCells[c][r].value) {
          throw new Error(`${value} already present at ${c},${r}`);
        }
      }
    }

    this.theCells[position.x][position.y] = new Cell(value);
  }

  markCell(position: Coordinate): void {
    if (!this.isInitialized()) {
      throw new Error("board not initialized");
    }
    this.theCells[position.x][position.y].mark();
  }

  isMarked(position: Coordinate): boolean {
    return this.theCells[position.x][position.y].isMarked();
  }

  isInitialized(): boolean {
    for (const row of this.theCells) {
      for (const col of row) {
        if (col.value === null) {
          return false;
        }
      }
    }
    return true;
  }
}
