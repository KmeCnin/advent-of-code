castInt :: [Char] -> Int
castInt ('+':string) = castInt string
castInt string = read string

lastDefault :: [t] -> t -> t
lastDefault [] def = def
lastDefault list def = last list

push :: [t] -> t -> [t]
push [] element = [element]
push list element = list ++ [element]

firstDuplicate :: [Int] -> [Int] -> Int
firstDuplicate acc list = do
    let last = lastDefault acc 0
    let i = length acc
    let toAdd = list !! i
    let new = last + toAdd

    if elem new acc
    then new
    else firstDuplicate $ list push acc new

main = do
    input <- readFile "input"
    let list = map castInt $ lines input
    let first = firstDuplicate [] list
    print first