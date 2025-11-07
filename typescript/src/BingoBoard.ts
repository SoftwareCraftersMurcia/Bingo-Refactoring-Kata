class Cell {
  public readonly value: string | null;
  public marked: boolean;
  constructor (value: string | null, marked: boolean){
    this.value = value
    this.marked = marked
  }
}

export class BingoBoard {
  private readonly theCells: Cell[][];

  constructor(width: number, height: number) {
    this.theCells = Array.from({ length: width }, () =>
      Array.from({ length: height }, () => new Cell(null, false))
    );
  }

  defineCell(x: number, y: number, value: string): void {
    if (this.theCells[x][y].value !== null) {
      throw new Error("cell already defined");
    }

    for (let c = 0; c < this.theCells.length; c++) {
      for (let r = 0; r < this.theCells[c].length; r++) {
        if (value === this.theCells[c][r].value) {
          throw new Error(`${value} already present at ${c},${r}`);
        }
      }
    }

    this.theCells[x][y] = new Cell(value, false);
  }

  markCell(x: number, y: number): void {
    if (!this.isInitialized()) {
      throw new Error("board not initialized");
    }
    this.theCells[x][y].marked = true;
  }

  isMarked(x: number, y: number): boolean {
    return this.theCells[x][y].marked;
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
