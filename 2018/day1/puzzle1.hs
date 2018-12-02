module Main where
    import Data.List.Split
    import Data.List
    
    -- Extract sign from number strings.
    sign string = take 1 string 
    -- Remove + from positiv integers.
    cleanStrInt string = if sign string == "+" then drop 1 string else string
    -- Cast cleaned number strings to integers.
    strToInt string = read string :: Integer

    main = do input <- readFile "input"
              let listStr = splitOn "\n" input
              let listClean = map cleanStrInt listStr
              let listInt = map strToInt listClean
              let frequency = foldl (+) 0 listInt
              print frequency